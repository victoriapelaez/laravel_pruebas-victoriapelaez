<fieldset>
    <legend class="text-center header"></legend>

    <div class="form-group ">
        <i class="fa fa-user bigicon"></i>
        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
        <input type="text" name="nombre"
               value="{{ isset($datos->nombre)?$datos->nombre:old('nombre') }}"
               id="nombre" placeholder="Nombre" class="form-control"/><br>
    </div>

    <div class="form-group">
        <i class="fa fa-user bigicon"></i>
        <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
        <input type="text" name="apellido"
               value="{{ isset($datos->apellido)?$datos->apellido:old('apellido') }}"
               id="apellido" placeholder="Apellido" class="form-control"/><br>
    </div>

    <div class="form-group">
        <i class="fa fa-phone-square bigicon"></i>
        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
        <input type="text" name="telefono"
               value="{{ isset($datos->telefono)?$datos->telefono:old('telefono') }}"
               id="telefono" placeholder="Teléfono" class="form-control"/><br>
    </div>

    <div class="form-group">
        <i class="fa fa-envelope-o bigicon"></i>
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <input type="text" name="email"
               value="{{ isset($datos->email)?$datos->email:old('email') }}" id="email"
               placeholder="Email" class="form-control"/><br>
    </div>

    <div class="form-group">
        <i class="fa fa-user bigicon"></i>
        <label for="edad" class="col-sm-2 col-form-label">Edad</label>
        <input type="number" name="edad" value="{{ old('edad', $datos->edad ?? '') }}"
               id="edad"
               class="form-control"/><br>
    </div>

    <div class="form-group">
        <i class="fa fa-user bigicon"></i>
        <label for="nacimiento" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
        <input type="date" name="nacimiento"
               value="{{ isset($datos->nacimiento)?$datos->nacimiento:old('nacimiento') }}"
               id="nacimiento"
               class="form-control"/><br>
    </div>

    <i class="fa fa-pencil-square-o bigicon"></i>
    Deportes que practica:<br><br>
    <div class="form-check">
        <label for="deporte" class="col-sm-2 col-form-label">
            <input type="checkbox" name="deporte[]" id="futbol" class="form-check-input" value="1"
                   @if(is_array(old('deporte')) && in_array(1, old('deporte'))) checked @endif/>Fútbol
        </label><br>
        <label for="deporte" class="col-sm-2 col-form-label">
            <input type="checkbox" name="deporte[]" id="basket" class="form-check-input" value="2"
                   @if(is_array(old('deporte')) && in_array(2, old('deporte'))) checked @endif/>Basket
        </label><br>
        <label for="deporte" class="col-sm-2 col-form-label">
            <input type="checkbox" name="deporte[]" id="tennis" class="form-check-input" value="3"
                   @if(is_array(old('deporte')) && in_array(3, old('deporte'))) checked @endif/>Tennis
        </label><br>
    </div>
    <br>

    <i class="fa fa-pencil-square-o bigicon"></i>
    Idioma:<br><br>
    <div class="form-check">
        <input type="radio" id="espanol" name="idioma" class="form-check-input"
               value="espanol" {{ old('idioma') == "espanol" ? 'checked' : '' }}>
        <label for="espanol" class="col-sm-2 col-form-label">Español</label><br>
        <input type="radio" id="ingles" name="idioma" class="form-check-input"
               value="ingles" {{ old('idioma') == "ingles" ? 'checked' : '' }}>
        <label for="ingles" class="col-sm-2 col-form-label">Inglés</label><br>
    </div>
    <br>

    <div class="form-group">
        <i class="fa fa-pencil-square-o bigicon"></i>
        <label for="descripcion" class="col-form-label">Escribe una breve descripción de ti:</label><br>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="4" cols="50">{{ old('descripcion', $propiedad->descripcion ?? '') }}
        </textarea><br>
    </div>

    <i class="fa fa-pencil-square-o bigicon"></i>
    <label for="cars" class="col-sm-2 col-form-label">Elije un color favorito:</label><br>
    <div class="form-check">
        <select name="color" id="color" class="form-check-input">
            <option value="rojo" @if (old('color') === 'rojo') selected @endif>Rojo</option>
            <option value="azul" @if (old('color') === 'azul') selected @endif>Azul</option>
            <option value="verde" @if (old('color') === 'verde') selected @endif>Verde</option>
            <option value="amarillo" @if (old('color') === 'amarillo') selected @endif>Amarillo</option>
        </select><br>
    </div>
    <br>

    <div class="form-group">
        <i class="fa fa-user bigicon"></i>
        <label for="foto" class="col-sm-2 col-form-label">Foto</label><br>
        <input type="file" name="foto" value="" id="foto" class="col-form-label"/><br>
    </div>

    <button type="submit" class="btn btn-primary mb-2">Aceptar</button>

</fieldset>

