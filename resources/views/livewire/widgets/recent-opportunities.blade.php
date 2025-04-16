<div class="p-5 bg-white shadow-lg dark:bg-gray-800 rounded-xl">
    <h2 class="mb-3 text-lg font-semibold text-center text-gray-800 dark:text-gray-200">
        Oportunidades Recentes
    </h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="text-gray-800 bg-gray-200 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                <th class="p-3 text-left">Título</th>
                <th class="p-3 text-left">Estágio</th>
                <th class="p-3 text-left">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opportunities as $opportunity)
                <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="p-3 text-gray-800 dark:text-gray-200">{{ $opportunity->title }}</td>
                    <td class="flex items-center p-3 text-gray-800 dark:text-gray-200">
                        @if ($opportunity->stage->name === 'Contato Inicial')
                            <x-heroicon-o-chat-bubble-left class="w-5 h-5" style="color: #3B82F6;" />
                        @elseif ($opportunity->stage->name === 'Proposta Enviada')
                            <x-heroicon-o-paper-airplane class="w-5 h-5" style="color: #FACC15;" />
                        @elseif ($opportunity->stage->name === 'Negociação')
                            <x-heroicon-o-hand-raised class="w-5 h-5" style="color: #F97316;" />
                        @elseif ($opportunity->stage->name === 'Fechado (Ganho)')
                            <x-heroicon-o-check-circle class="w-5 h-5" style="color: #10B981;" />
                        @elseif ($opportunity->stage->name === 'Fechado (Perdido)')
                            <x-heroicon-o-x-circle class="w-5 h-5" style="color: #EF4444;" />
                        @endif
                        {{ $opportunity->stage->name }}
                    </td>
                    <td class="p-3 text-gray-800 dark:text-gray-200">{{ $opportunity->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="flex justify-center mt-4">
        {{ $opportunities->links() }}
    </div>
</div>
