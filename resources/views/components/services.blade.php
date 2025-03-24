<form action="{{ route('dashboard') }}" method="POST">
    @csrf
    <label for="service">Destino:</label>
    <select name="service" id="service">
    </select>
    <button type="submit">Enviar</button>
</form>
