<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <p class="py-3">
                        <button class="btn btn-primary" id="create_product">Create New Product</button>
                    </p>
                    <table class="table display" id="product_table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Create Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_product" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="product_name" name="name" autocomplete="false" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_qty" class="form-label">Qty</label>
                            <input type="number" name="qty" id="product_qty" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="number" name="price" id="product_price" class="form-control" required>
                        </div>



                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Update Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_product_update" autocomplete="off">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="id" id="product_id">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="product_name_update" name="name" autocomplete="false" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_qty" class="form-label">Qty</label>
                            <input type="number" name="qty" id="product_qty_update" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="number" name="price" id="product_price_update" class="form-control" required>
                        </div>



                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->

    <div class="toast-container position-fixed  bottom-0 end-0 p-3">
        <div id="toast_success" class="toast text-bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>

                <button class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed  bottom-0 end-0 p-3">
        <div id="toast_error" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>

                <button class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
</x-app-layout>