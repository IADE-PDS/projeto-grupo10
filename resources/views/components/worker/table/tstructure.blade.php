<section class="container px-4 mx-auto m-2 ">
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border bordered border-success rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        {{-- Titulos da tabela --}}
                        <x-worker.table.thead />

                        {{-- Corpo da tabela com os dados --}}
                        <tbody class="bg-white divide-y divide-gray-200">
                            @yield('table-body')
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
