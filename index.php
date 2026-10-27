
<?php include 'layouts/header.php'; ?>
<div class="container mt-5">
    <div class="card p-4 mx-auto" style="max-width: 500px;">
        <h1 class="text-center mb-4">✨ Descubra seu Signo ✨</h1>
        <p class="text-center">
            Informe sua data de nascimento para descobrir seu signo zodiacal.
        </p>
        <form method="POST" action="mostrar_signo_do_zodiaco.php">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">
                    Data de nascimento
                </label>
                <input
                    type="date"
                    class="form-control"
                    id="data_nascimento"
                    name="data_nascimento"
                    required
                >
            </div>
            <button type="submit" class="btn btn-primary w-100">
                Descobrir meu signo
            </button>
        </form>
    </div>
</div>
</body>
</html>
