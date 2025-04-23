@extends('layouts.app.app')

@section('content')
<div class="container mt-5">
    <!-- Başlık ve Açıklama -->
    <div class="row mb-3 d-flex align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h3 class="text-primary">Kullanıcı Listesi</h3>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-end">
            <span class="badge bg-info text-dark p-2" style="font-style: italic; font-weight:600;">
                Kullanıcı listesi ile sistemdeki kullanıcıları yönetebilirsiniz.
            </span>
        </div>
    </div>
    <hr/>

    <!-- Kart Başlık ve Butonlar -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="btn-group">
                {{-- <a href="{{ route('users/new') }}" class="btn btn-success btn-sm"> --}}
                    <i class="bi bi-person-plus"></i> Yeni Ekle
                </a>
                <button type="button" class="btn btn-primary btn-sm editUserBtn" disabled data-bs-toggle="tooltip" data-bs-placement="top" title="Seçili kullanıcıyı düzenle">
                    <i class="bi bi-pencil-square"></i> Düzenle
                </button>
                <button type="button" class="btn btn-danger btn-sm deleteUserBtn" disabled data-bs-toggle="tooltip" data-bs-placement="top" title="Seçili kullanıcıyı sil">
                    <i class="bi bi-trash"></i> Sil
                </button>
            </div>
        </div>

        <!-- Kart İçeriği ve Tablo -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="usersTable">
                    <thead>
                        <tr>
                            <th>Adı Soyadı</th>
                            <th>E-Mail Adresi</th>
                            <th>Telefon Numarası</th>
                            <th>Durumu</th>
                            <th width="150">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Kullanıcılar buraya gelecek -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script type="text/javascript">
    var checkInterval = setInterval(function() {
            if (app.loader !== undefined && app.loader !== null) {
                app.loader.setModule("Users");
                clearInterval(checkInterval);
            }
        }, 500);
</script>
@endsection
