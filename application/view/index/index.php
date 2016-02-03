    <main class= "card">
      <section class="card-image">
        <img src="img/portada.jpg" alt="Portada ADV Trabajos Verticales Cadiz">
        <article class="card-title">
          <div class="row">
            <div class="col s3">
                <img src="img/adv-trabajos-verticales-cadiz.jpg" alt="ADV Trabajos Verticales Cadiz">
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <h3><strong>¡¡Pintura, limpieza, reparaciones...!!</strong></h3>
              <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header">
                    <h5><strong>El ahorro económico está en la utilización de técnicas rápidas y seguras.</strong></h5>
                    <h6 class="btn waves-effect waves-light ">Saber más &raquo;</h6>
                  </div>
                  <div class="collapsible-body">
                    <p class="flow-text">Trabajos en alturas en lugares de díficil acceso mediante sistemas de acceso y posicionamiento con técnicas de doble cuerda.
                    <br>Realizar cualquier tipo de trabajo en menos tiempo y con la misma efectividad que utilizando medios convencionales como andamios, plataformas o gruas, teniendo en cuenta en en algunos lugares no se pueden utilizar por motivos de espacio, tráfico, accesibilidad, economía, seguridad, robos, labores puntuales, etc.</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </article>
      </section>
      <section class="row">
        <!-- Example row of columns -->
        <article class="col s12 m4">
          <h2>Quienes somos</h2>
          <p>Somos ADV Trabajos Verticales, una empresa con dilatada experiencia en  el sector de trabajos en altura en la provincia de Cádiz. Nuestros servicios están dirigidos a toda clase de actividad en lugares de difícil acceso mediante técnicas de escalada aplicadas a la edificación e industria, sin utilizar andamios ni grúas. Accedemos al lugar en un corto espacio de tiempo, realizamos nuestra labor y recogemos en el mismo día sin ningún tipo de problemas e inconvenientes para el usuario.  Consulte con nosotros. Usamos todas las primeras marcas del mercado,no rebajamos costos en materiales. El ahorro económico está en la utilización de técnicas rápidas y seguras. </p>
        </article>
        <article class="col s12 m4">
          <section class="row">
            <article class="col s12">
              <h2>Dónde estamos</h2>
              <address>
                <strong>ADV Trabajos Verticales</strong><br>
                Calle Sol, 54 <br>
                11560 Trebujena (Cádiz)<br>
                <a href="mailto:#">E-mail: info@advtrabajosverticales.com</a><br>
                <abbr title="Telefono">Tlfno: 652 181 935</abbr><br>
              </address>
            </article>
          </section>
          <section class="row">
            <div class="col s12" id="map_canvas" style="height: 350px"></div>
          </section>
        </article> <!-- /section -->
        <article class="col s12 m4">
          <h2>Qué ofrecemos</h2>
          <li>Aislamientos sin obras.</li>
          <li>Rehabilitación energética fácil.</li>
          <li>Sellado de grietas juntas de dilatación.</li>
          <li>Reparación de desperfectos en fachadas y patios.</li>
          <li>Limpieza paredes,ladrillos,piedras,zócalos.</li>
          <li>Pintura y  tratamientos hidrófugos de paramentos verticales.</li>
          <li>Impermeabilización de cubiertas.</li>
          <li>Dispositivos antiaves en edificios.</li>
          <li>Montajes carteles y rótulos publicitarios.</li>
          <li>Instalaciones de canalizaciones verticales.</li>
          <li>Limpieza de cristales, persianas, muros cortina.</li>
          <li>Montaje en torres de telecomunicaciones y eléctricas.</li>
          <li>Trabajos en aerogeneradores.</li>
        </article>
      </section> <!-- /section -->
    </main>
  <script type="text/javascript">
    var peticion = null;

    function inicializa_xhr() {
      if(window.XMLHttpRequest) {
        return new XMLHttpRequest();
      } else if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
      }
    }

    function cargaMunicipios() {
      var lista = document.getElementById("provincia");
      var provincia = lista.options[lista.selectedIndex].value;
      if(!isNaN(provincia)) {
        peticion = inicializa_xhr();
        if (peticion) {
          peticion.onreadystatechange = muestraMunicipios;
          peticion.open("POST", url + "register/loadCity?nocache=" + Math.random(), true);
          peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          peticion.send("provincia=" + provincia);
        }
      }
    }

    function muestraMunicipios() {
      if (peticion.readyState == 4) {
        if (peticion.status == 200) {
          var lista = document.getElementById("municipio");
          var municipios = eval('(' + peticion.responseText + ')');

          lista.options.length = 0;
          var i=0;
          for(var codigo in municipios) {
            lista.options[i] = new Option(municipios[codigo], codigo);
            i++;
          }
        }
      }
    }

    window.onload = function() {
      peticion = inicializa_xhr();

      document.getElementById("provincia").onchange = cargaMunicipios;
    };
  </script>;
