// Ruta sugerida: js/dashboard.js

document.addEventListener('DOMContentLoaded', () => {
  const token = localStorage.getItem('token');

  if (!token) {
    console.warn("Token no encontrado en localStorage.");
    window.location.href = '../html/login.html';
    return;
  }

  // Mostrar en consola lo que se enviará
  const payload = { token: token };
  console.log("Enviando al servidor:", JSON.stringify(payload));

  // Validar el token con el backend
  fetch('../php/auth/verify_token.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
    credentials: 'same-origin'
  })
    .then(response => response.json())
    .then(data => {
      console.log("Respuesta del servidor:", data);
      if (!data.valido) {
        localStorage.removeItem('token');
        window.location.href = '../html/login.html';
      } else {
        // Mostrar el contenido solo si el token es válido
        document.body.style.display = 'block';
      }
    })
    .catch(error => {
      console.error('Error al verificar el token:', error);
      localStorage.removeItem('token');
      window.location.href = '../html/login.html';
    });
});
