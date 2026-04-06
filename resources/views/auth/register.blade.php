<form method="POST" action="/register">
    @csrf
    <input name="name" placeholder="Nama">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button>Register</button>
</form>
