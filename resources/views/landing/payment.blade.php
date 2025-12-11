@extends('landing.master')

@section('content')
    <section class="py-12 bg-gray-50 min-h-screen flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="relative h-64">
                    <img src="{{ asset('/storage/' . $campaign->foto_campaign) }}" class="w-full h-full object-cover" alt="{{ $campaign->judul_campaign }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h4 class="text-2xl font-bold text-white">{{ $campaign->judul_campaign }}</h4>
                    </div>
                </div>
                
                <div class="p-8">
                    @if(session('success'))
                    <div class="flex items-center p-4 mb-6 text-green-800 rounded-xl bg-green-50 border border-green-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Nama Donatur</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 text-gray-700 font-semibold" value="{{ $transaksi->nama }}" disabled>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Jumlah Donasi (IDR)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-500 font-bold">Rp</span>
                                <input type="number" class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 border-gray-200 text-gray-900 font-bold text-lg" value="{{ $transaksi->nominal_transaksi }}" disabled>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Pesan / Doa</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 text-gray-700 italic" value="{{ $transaksi->keterangan }}" disabled>
                        </div>

                        <button id="pay-button" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-1">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.server_key') }}">
    </script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $transaksi->token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.href = '/campaign/{{ $campaign->slug_campaign }}';
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
