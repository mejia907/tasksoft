<section wire:poll="loadTasksAll">
    <button wire:click="toggleModal"
        class="border border-primary py-2 px-6 text-white inline-block rounded bg-green-600 hover:bg-primary hover:bg-green-700 my-6">
        Nueva
    </button>
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
                <th class="w-1/12 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4">
                    Estado
                </th>
                <th
                    class="w-1/4 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-r border-transparent">
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
                    <td
                        class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                        {{ $task->description }}
                    </td>
                    <td
                        class="text-center text-dark font-medium text-base py-5 px-2 bg-[#F3F6FF] border-b border-[#E8E8E8]">
                        {{ $task->status }}
                    </td>
                    <td
                        class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-r border-[#E8E8E8]">
                        <div class="flex justify-center items-center">
                            @if (isset($task->pivot))
                                <button
                                    class="border border-primary py-2 px-6 mx-1 text-primary inline-block rounded hover:bg-primary hover:text-amber-600 hover:border-amber-500"
                                    wire:click="unSharedTask({{ $task }})">
                                    Desvincular
                                </button>
                            @endif
                            @if ((isset($task->pivot) && $task->pivot->permission == 'edit') || auth()->user()->id == $task->user_id)
                                <button
                                    class="border border-primary py-2 px-6 mx-1 text-primary inline-block rounded hover:bg-primary hover:text-blue-600 hover:border-blue-500"
                                    wire:click="updateTask({{ $task }})">
                                    Editar
                                </button>
                                <button
                                    class="border border-primary py-2 px-6 mx-1 text-primary inline-block rounded hover:bg-primary hover:text-green-600 hover:border-green-500"
                                    wire:click="toggleModalShared({{ $task }})">
                                    Compartir
                                </button>
                                <button
                                    class="border border-primary py-2 px-6 mx-1 text-primary inline-block rounded hover:bg-primary hover:text-red-600 hover:border-red-500"
                                    wire:click="deleteTask({{ $task }})"
                                    wire:confirm="Deseas eliminar la tarea?">
                                    Eliminar
                                </button>
                        </div>
            @endif
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($modal)
        <!-- Modal -->
        <div class="min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
            id="modal-id">
            <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div class="">
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 -m-1 flex items-center mx-auto"
                            viewBox="0 0 24 24" fill="none" stroke="#0e4bd9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                            <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                        </svg>
                        <h2 class="text-xl font-bold pt-2 ">Crear Tarea</h3>
                            <form>
                                <div class="mt-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="title">
                                        Título
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                                        id="title" name="title" type="text" placeholder="Título" for="title"
                                        autofocus wire:model="title">
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="title">
                                        Descripción
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                                        id="description" name="description" type="text" placeholder="Descripción"
                                        for="description" wire:model="description">
                                </div>

                            </form>
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button
                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100"
                            wire:click="toggleModal">
                            Cancelar
                        </button>
                        <button
                            class="mb-2 md:mb-0 bg-green-600 border border-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-700"
                            wire:click.prevent="addOrUpdateTask">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($modalShared)
        <!-- Modal Sahred -->
        <div class="min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
            id="modal-id">
            <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div class="">
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 -m-1 flex items-center mx-auto"
                            viewBox="0 0 24 24" fill="none" stroke="#0e4bd9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3"></circle>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                        </svg>
                        <h2 class="text-xl font-bold pt-2 ">Compartir Tarea</h3>
                            <form>
                                <div class="mt-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="title">
                                        Usuario
                                    </label>
                                    <select wire:model="user_id"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Seleccionar usuario</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"> {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 text-left"
                                        for="title">
                                        Permiso
                                    </label>
                                    <select wire:model="permission"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Seleccionar un permiso</option>
                                        <option value="view">Ver</option>
                                        <option value="edit">Editar</option>
                                        <option value="delete">Eliminar</option>
                                    </select>

                                </div>

                            </form>
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button
                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100"
                            wire:click="toggleModalShared">
                            Cancelar
                        </button>
                        <button
                            class="mb-2 md:mb-0 bg-green-600 border border-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-700"
                            wire:click.prevent="sharedTask">Compartir</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
