<div class="mx-auto max-w-6xl px-4 py-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Dashboard Pelapor
            </h1>
            <p class="mt-1 text-slate-600">
                Selamat datang, {{ auth()->user()->name }}.
            </p>
        </div>

        <button
            wire:click="logout"
            class="rounded-xl bg-red-600 px-5 py-3 font-semibold text-white hover:bg-red-700"
        >
            Logout
        </button>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="mb-5 text-xl font-bold text-slate-900">
            Riwayat Permintaan Maintenance
        </h2>

        @if ($permintaanMaintenances->isEmpty())
            <div class="rounded-xl bg-slate-50 p-6 text-center text-slate-600">
                Belum ada permintaan maintenance.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b bg-slate-50">
                            <th class="p-3">Kode</th>
                            <th class="p-3">Judul</th>
                            <th class="p-3">Prioritas</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaanMaintenances as $item)
                            <tr class="border-b">
                                <td class="p-3 font-semibold">
                                    {{ $item->kode_permintaan }}
                                </td>
                                <td class="p-3">
                                    {{ $item->judul }}
                                </td>
                                <td class="p-3 capitalize">
                                    {{ $item->prioritas }}
                                </td>
                                <td class="p-3 capitalize">
                                    {{ str_replace('_', ' ', $item->status) }}
                                </td>
                                <td class="p-3">
                                    {{ $item->created_at?->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>