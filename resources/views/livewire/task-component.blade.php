<div>
    <a href="javascript:void(0)"
        class="border border-primary py-2 px-6 text-white inline-block rounded bg-green-600 hover:bg-primary hover:bg-green-700 my-6">
        Nueva
    </a>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-blue-800 text-center">
                <th
                    class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-l border-transparent">
                    Titulo
                </th>
                <th class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4">
                    Descripción
                </th>
                <th class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4">
                    Estado
                </th>
                <th
                    class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-r border-transparent">
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td
                        class="text-center text-dark font-medium text-base py-5 px-2 bg-[#F3F6FF] border-b border-l border-[#E8E8E8]">
                        {{ $task->title }}
                    </td>
                    <td class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                        {{ $task->description }}
                    </td>
                    <td
                        class="text-center text-dark font-medium text-base py-5 px-2 bg-[#F3F6FF] border-b border-[#E8E8E8]">
                        {{ $task->status }}
                    </td>

                    <td
                        class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-r border-[#E8E8E8]">
                        <a href="javascript:void(0)"
                            class="border border-primary py-2 px-6 text-primary inline-block rounded hover:bg-primary hover:text-blue-600 hover:border-blue-500">
                            Editar
                        </a>
                        <a href="javascript:void(0)"
                            class="border border-primary py-2 px-6 text-primary inline-block rounded hover:bg-primary hover:text-red-600 hover:border-red-500">
                            Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
