@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pedidos Cancelados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Devolución</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->producto->nombre ?? 'N/A' }}</td>
                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>
                    @if($pedido->estado === 'cancelado')
                        @if($pedido->returnRequest)
                            <span class="badge bg-info">
                                Solicitud enviada ({{ $pedido->returnRequest->estado }})
                            </span>
                        @else
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#devolucionModal" data-pedido="{{ $pedido->id }}">
                                Solicitar devolución
                            </button>
                        @endif
                    @else
                        <span class="text-muted">No disponible</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Devolución -->
<div class="modal fade" id="devolucionModal" tabindex="-1" aria-labelledby="devolucionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('returns.store') }}">
        @csrf
        <input type="hidden" name="pedido_id" id="pedido_id_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="devolucionModalLabel">Solicitar Devolución</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo de la devolución</label>
                    <textarea class="form-control" name="motivo" id="motivo" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Enviar solicitud</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var devolucionModal = document.getElementById('devolucionModal');
    devolucionModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var pedidoId = button.getAttribute('data-pedido');
        document.getElementById('pedido_id_modal').value = pedidoId;
    });
});
</script>

{{-- 
==========================
INSTRUCCIONES DEVOLUCIONES
==========================
1. MIGRACIÓN returns:
    php artisan make:migration create_returns_table
    // En la migración:
    Schema::create('returns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pedido_id');
        $table->text('motivo');
        $table->string('estado')->default('pendiente');
        $table->timestamps();
        $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
    });

2. MODELO Return:
    php artisan make:model Return
    // En app/Models/Return.php:
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    class Return extends Model {
        protected $fillable = ['pedido_id', 'motivo', 'estado'];
        public function pedido() {
            return $this->belongsTo(Pedido::class);
        }
    }

3. CONTROLADOR ReturnsController:
    php artisan make:controller ReturnsController
    // En app/Http/Controllers/ReturnsController.php:
    namespace App\Http\Controllers;
    use App\Models\Return;
    use Illuminate\Http\Request;
    class ReturnsController extends Controller {
        public function store(Request $request) {
            $request->validate([
                'pedido_id' => 'required|exists:pedidos,id',
                'motivo' => 'required|string',
            ]);
            Return::create([
                'pedido_id' => $request->pedido_id,
                'motivo' => $request->motivo,
                'estado' => 'pendiente',
            ]);
            return redirect()->back()->with('success', 'Solicitud enviada');
        }
        // Métodos para aceptar/rechazar pueden añadirse aquí
    }

4. RUTAS:
    // En routes/web.php:
    use App\Http\Controllers\ReturnsController;
    Route::post('/returns', [ReturnsController::class, 'store'])->name('returns.store');

5. RELACIÓN EN MODELO Pedido:
    // En app/Models/Pedido.php:
    public function returnRequest() {
        return $this->hasOne(\App\Models\Return::class, 'pedido_id');
    }

6. VISTA (ya implementada abajo)
--}}
@endsection
