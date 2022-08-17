<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PurchasedBook;
use Exception;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Illuminate\Support\Facades\Auth;
use Shetabit\Payment\Facade\Payment;
use SoapFault;
use Yajra\DataTables\DataTables;

class BookPurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function purchase(Book $book)
    {

        if ($book->isPurchased()){
            return to_route('admin.book.show',compact('book'));
        }else{
        try {
        $invoice = new Invoice();
        $invoice->amount($book->price);


        $user = Auth::user();

        $paymentId = md5(uniqid());
        $transaction = $user->transactions()->create([
            'book_id' => $book->id,
            'paid' => $invoice->getAmount(),
            'invoice_details' => $invoice,
            'payment_id' => $paymentId,

        ]);

        $callbackUrl = route('admin.book.purchase.result',[$book->id,'payment_id' => $paymentId]);
        $payment = Payment::callbackUrl($callbackUrl);
        $payment->config('description','خرید '.$book->title);

        $payment->purchase($invoice,function($driver,$transactionId) use ($transaction){
            $transaction->transaction_id = $transactionId;
            $transaction->save();
        });

       return $payment->pay()->render();
    }catch (PurchaseFailedException|Exception|SoapFault $e){
            $transaction->transaction_result = [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->save();

            return to_route('admin.book.index')->with('toast-error','مشکلی به وجود آمده است');
        }
    }}

    public function result(Request $request, Book $book)
    {
        if ($request->missing('payment_id')) {
            return to_route('admin.book.index')->with('toast-error','مشکلی به وجود آمده است');
        }
        $transaction = Transaction::where('payment_id',$request->payment_id)->first();
        if (empty($transaction)|
            $transaction->user_id !== Auth::id()|
            $transaction->book_id !== $book->id|
            $transaction->status !== Transaction::STATUS_PENDING)
        {
            return to_route('admin.book.index')->with('toast-error','مشکلی به وجود آمده است');
        }
        try {
            $receipt = Payment::amount($transaction->paid)->transactionId($transaction->transaction_id)->verify();

            $transaction->transaction_result = $receipt;
            $transaction->status = Transaction::STATUS_SUCCESS;
            $transaction->save();
            Auth::user()->purchasedBooks()->create([
                'book_id' => $book->id
            ]);

            return view('admin.pages.book.result')->with([
                'status'=>1,
                'message' => $receipt->getReferenceId(),
                'book' => $book
            ]);


        }catch (Exception|InvalidPaymentException $e){
            if ($e ->getCode() < 0){
                $transaction->status = Transaction::STATUS_FAILED;
                $transaction->transaction_result = [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ];
                $transaction->save();

                return view('admin.pages.book.result')->with(['status'=>$e->getCode(),'message' => $e->getMessage()]);
            }
        }
    }

    public function transactionShow(Request $request )
    {
        if ($request->ajax()) {
            return DataTables::of(Transaction::select('id','payment_id','user_id','book_id','paid','status','transaction_id')->orderBy('id', 'DESC'))
                ->editColumn('payment_id', function (Transaction $transaction) {
                    return $transaction->payment_id;
                })
                ->editColumn('user', function (Transaction $transaction) {
                    return $transaction->user->fullname;
                })
                ->editColumn('book', function (Transaction $transaction) {
                    return $transaction->book->title;
                })
                ->editColumn('paid', function (Transaction $transaction) {
                    return $transaction->paid;
                })
                ->editColumn('status', function (Transaction $transaction) {
                        if ($transaction->status == 2) {
                            return '<span class="badge bg-label-primary m-1">' . 'پرداخت شده' . '</span>';
                        } else {
                            return '<span class="badge bg-label-danger m-1">' . 'پرداخت نشده' . '</span>';
                        }

                })
                    ->editColumn('transaction_id', function (Transaction $transaction) {
                        return $transaction->transaction_id;
                    })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('admin.pages.book.transactionIndex');
    }


    }


