<div id="contact">
    <form method="post" action="./">
        <div>
            <label>
                Objet:
                <input type="text" name="object">
            </label>
            <?php if (isset($_SESSION['id'])): ?>
                <label>
                    Courriel:
                    <input type="email" name="courriel">
                </label>
            <?php endif />
        </div>
        <label>
            Message:
            <textbox name="message"></textbox>
        </label>
    </form>
<div>
