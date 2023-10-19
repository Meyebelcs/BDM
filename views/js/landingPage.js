      // Obtén referencias a los elementos del DOM
      const toggleMenuButton = document.getElementById('toggleMenu');
      const menuContainer = document.getElementById('menuContainer');

      // Agrega un evento clic al botón de alternar menú
      toggleMenuButton.addEventListener('click', function () {
        // Verifica si el menú está oculto
        if (menuContainer.style.display === 'none' || menuContainer.style.display === '') {
          // Muestra el menú
          menuContainer.style.display = 'block';
        } else {
          // Oculta el menú
          menuContainer.style.display = 'none';
        }
      });