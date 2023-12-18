<a class="btn btn-secondary me-3 btn-block" data-bs-toggle="collapse" href="#collapseObservaciones" role="button"
    aria-expanded="false" aria-controls="collapseObservaciones">
    <i class="fa-solid fa-file-pen me-1"></i>
    Agregar observaciones
</a>
<div class="collapse mt-3 mb-3" id="collapseObservaciones">
    <div class="form-group">
        <label for="observaciones">Digite sus observaciones: </label>
        <textarea id="observaciones" rows="5" class="form-control @error('observacion') is-invalid @enderror"
            name="observacion"></textarea>
        <div class="invalid-feedback">
            @error('observacion')
                {{ $message }}
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-warning mt-2">
        <i class="fa-solid fa-paper-plane me-1"></i>
        Enviar
    </button>
</div>
