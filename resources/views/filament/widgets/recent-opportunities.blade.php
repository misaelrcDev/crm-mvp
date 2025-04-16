<x-filament-widgets::widget>
    <x-filament::section>
        <div class="w-full p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <h2 class="mb-4 text-lg font-semibold text-center text-gray-800 dark:text-gray-200">
                Oportunidades Recentes
            </h2>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="p-2 text-left text-gray-800 dark:text-gray-300">Título</th>
                        <th class="p-2 text-left text-gray-800 dark:text-gray-300">Estágio</th>
                        <th class="p-2 text-left text-gray-800 dark:text-gray-300">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($opportunities as $opportunity)
                        <tr class="border-b border-gray-300 dark:border-gray-600">
                            <td class="p-2 text-gray-800 dark:text-gray-200">{{ $opportunity->title }}</td>
                            <td class="p-2 text-gray-800 dark:text-gray-200">{{ $opportunity->stage->name }}</td>
                            <td class="p-2 text-gray-800 dark:text-gray-200">{{ $opportunity->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
