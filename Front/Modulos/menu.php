<div id="side-menu">
    <div class="bars">
        <div class="menu-bar"></div>
        <div class="menu-bar"></div>
        <div class="menu-bar"></div>
    </div>

    <a href="Front/Modulos/index.php" class="side-link">🏠 Início</a>
    <a href="form_login.php?tipo=entrar" class="side-link">🔑 Login</a>
    <a href="listar_sala.php" class="side-link">📚 Salas</a>
    <a href="form_nova_sala.php" class="side-link">forma sala</a>
    <a href="config_sala.php" class="side-link">config sala</a>
    <script>
const bars = document.querySelector(".bars");
const menu = document.querySelector("#side-menu");

bars.addEventListener("click", () => {
    menu.classList.toggle("open");
});
</script>
</div>
