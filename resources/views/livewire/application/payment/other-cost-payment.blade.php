<div>
    <x-loading-indicator/>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-id-card"></i> GESTION DE PAIEMENT DES FRAIS</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-5">
                    @livewire('application.payment.list.list-student-for-payment')
                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    @livewire('application.payment.list.list-payment-by-day')
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
