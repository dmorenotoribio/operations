1. Lo primero, es que, nos creemos nuestro propio proyecto, ya que a mi, por lo menos, no me gusta tener que meter en el composer de laravel referencias de otros proyectos ya que esto no me ayuda a comprender que está haciendo el código, por eso, creamos nuestro proyecto y después copiamos la carpeta “Circuit” dentro de la carpeta de la aplicación “App”. Para crear el proyecto, debemos de utilizar la versión 5.6 de laravel, ya que en versiones superiores no esta probado y puede que no funcione correctamente.

composer create-project — prefer-dist laravel/laravel=”5.6.*” operations

2. Una vez tenemos el proyecto creado y la carpeta copiada, meteremos la referencia a esta carpeta para que el service provider de laravel nos genere las referencias necesarias a las clases. Vamos a la clase situada en “config/app.php” en la parte de abajo donde ser registran los providers insertamos esta línea.

App\Circuit\Provider\CircuitBreakerServiceProvider::class,


3. Con esto ya hecho, en la carpeta “config“ del proyecto, creamos una clase de configuración la cual llamaremos “circuit_breaker.php”. Esta clase es muy importante ya que contiene la configuración de los tiempos de espera y los intentos que va a manejar el circuito.


La clave “defaults” contiene los valores por defecto que asignamos al circuito, la clave “services” contiene cada uno de nuestros servicios de forma independiente de manera que podemos tener varios servicios con intentos de fallo y tiempos de corte diferentes. Los valores a tener en cuenta son los siguientes :

attempts_threshold : En esta clave, especificamos cuantos intentos se tienen que hacer antes de abrir el circuito y declarar que el servicio a fallado.

attempts_ttl : En esta clave, especificamos la ventana de tiempo (en minutos) en la que estamos validando la acción y realizando los intentos antes de declarar que el servicio a fallado.

failure_ttl : En esta clase, especificamos el tiempo que permanecerá el servicio abierto y fuera de actividad. Hay que tener en cuenta que aunque el servicio se restablezca si el tiempo que hemos definido aquí no ha transcurrido no se volverá a cerrar el circuito.

4. Esto es todo lo que necesitamos para tener listo nuestro circuito, ahora solamente falta probarlo, podemos crear un controlador, una ruta api, y poner este simple código con el que podemos manejar para abrir y cerrar el circuito.


El funcionamiento es muy sencillo, utilizamos el patrón haciendo uso de la clase que implementa una fachada, con esto evitamos tener que acoplarnos a la implementación del patrón y poder ampliar en cualquier momento.

Seguidamente, en cada uno de nuestros procesos que queramos controlar preguntamos si el circuito está disponible (1), en el caso de que anteriormente se hubiera generado un error, el circuito se encontrara abierto (4) por lo que no se ejecutara nada de código. En caso de que el circuito esté disponible se realizaran las acciones necesarias, si se genera error (2) marcamos el circuito con error y terminamos la acción. Si la acción es correcta marcamos el suceso como correcto (3).


Con este ejemplo podemos ver como un simple patrón nos ayuda a dormir tranquilos y no preocuparnos si un sistema ajeno a nosotros falla, controlar aquellas excepciones que hacen que se rompa el sistema y meter tiempos de espera para no saturar procesos que están caídos. En definitiva, un patrón muy interesante que tiene muchas aplicaciones.
