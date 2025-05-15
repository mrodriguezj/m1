// Ruta sugerida: /js/login.js

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  const usuarioInput = document.getElementById("usuario");
  const passwordInput = document.getElementById("password");
  const errorMsg = document.getElementById("errorMsg");

  // Validación en tiempo real para solo letras
  usuarioInput.addEventListener("input", () => {
    const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]*$/;
    if (!soloLetras.test(usuarioInput.value)) {
      usuarioInput.value = usuarioInput.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, "");
      usuarioInput.classList.add("border-red-500");
      usuarioInput.setCustomValidity("Solo se permiten letras.");
    } else {
      usuarioInput.classList.remove("border-red-500");
      usuarioInput.setCustomValidity("");
    }
  });

  // Envío del formulario
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const usuario = usuarioInput.value.trim();
    const password = passwordInput.value;

    try {
      const response = await fetch("/php/auth/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ usuario, password }),
      });

      const data = await response.json();

      if (!response.ok || !data.token) {
        throw new Error(data.error || "Error desconocido");
      }

      localStorage.setItem("authToken", data.token);
      localStorage.setItem("authTokenExp", Date.now() + 10 * 60 * 1000); // 10 minutos
      window.location.href = "/html/dashboard.html"; // Redirige tras login
    } catch (err) {
      console.error("Error al iniciar sesión:", err.message);
      errorMsg.classList.remove("hidden");
    }
  });
});
