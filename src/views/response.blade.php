@extends('Payzone::layout')

@section('header')
    {{ __("Thank you Page") }}
@endsection

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if($transactionresult->getStatusCode() === '20')
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        PreviousMessage
                                                    </div>
                                                    <div class="text-sm text-green-500">
                                                        {{ $transactionresult->getPreviousMessage() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        Message:
                                                    </div>
                                                    <div class="text-sm text-green-500">
                                                        {{ $transactionresult->getMessage() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Status Code</div>
                                            <div class="text-sm text-green-500">{{ $transactionresult->getStatusCode() }}</div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Cross Reference
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $transactionresult->getCrossReference() }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Transaction Outcome</div>
                                        <div class="text-sm @if($transactionresult->getStatusCode()!=0) text-red-500 @else text-green-500 @endif">{{ $transactionresult->getTransactionOutcome() }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Outcome Detail
                                                </div>
                                                <div class="text-sm @if($transactionresult->getStatusCode()!=0) text-red-500 @else text-green-500 @endif">
                                                    {{ $transactionresult->getTransactionOutcomeDetail() }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Order ID</div>
                                        <div class="text-sm @if($transactionresult->getStatusCode()!=0) text-red-500 @else text-green-500 @endif">{{ $transactionresult->getOrderID() }}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="py-4">
                            <div class="inline-flex rounded-md shadow mt-4">
                                <a href="{{ config("app.url") }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Back to home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')@endsection
