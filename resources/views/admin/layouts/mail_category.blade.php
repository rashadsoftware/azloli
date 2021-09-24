<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dosyalar</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                    <a href="{{route('admin.mail')}}" class="nav-link">
                        <i class="fas fa-inbox"></i> Gələnlər Qutusu
                        @if(DB::table('mails')->where('mail_read', 'unread')->count() > 0)
                        <span class="badge bg-primary float-right">{{DB::table('mails')->where('mail_read', 'unread')->count()}}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->