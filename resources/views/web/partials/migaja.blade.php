  <!-- MIGAJA -->
  <style>
      /* MIGAJA */
      .contenedor_pagina_carrito .contenedor_migaja ul {
          display: flex;
          align-items: center;
          min-height: 32px;
          padding: 0 19px;
          background-color: transparent;
          list-style: none;
      }

      .contenedor_pagina_carrito .contenedor_migaja ul li {
          position: relative;
          margin: 0px 8px;
      }

      .contenedor_pagina_carrito .contenedor_migaja ul li::after {
          content: '/';
          position: absolute;
          right: -12px;
          top: 50%;
          transform: translateY(-50%);
          color: #000;
      }

      .contenedor_pagina_carrito .contenedor_migaja ul li:last-child::after {
          content: '';
      }
  </style>
  <div class="contenedor_migaja">
      <ul>
          <li> <a href="">Inicio</a> </li>
          <li> <a href="">Carrito</a> </li>
          <li> <a href="">Checkout</a> </li>
      </ul>
  </div>
