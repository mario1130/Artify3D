@extends('layouts.plantilla')

@section('title', 'Términos y Condiciones')

@section('context')
<style>
    .terms-container {
        max-width: 800px;
        margin: 40px auto;
        background: #181818;
        color: #f0f0f0;
        border-radius: 10px;
        padding: 32px 24px;
        box-shadow: 0 2px 8px #0002;
        font-size: 1.05em;
        line-height: 1.7;
    }
    .terms-container h1, .terms-container h2, .terms-container h3 {
        color: #1D7129;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
    }
    .terms-container ul {
        margin-left: 1.5em;
        margin-bottom: 1em;
    }
    .terms-container strong {
        color: #fff;
    }
</style>

<div class="terms-container">
    <h1>Términos y Condiciones</h1>
    <p><strong>Última actualización:</strong> 16 de noviembre de 2024</p>

    <h2>1. Aceptación de los Términos</h2>
    <p>
        Al acceder y utilizar este sitio web (“Sitio”) y nuestros servicios (“Servicios”), usted acepta cumplir y estar sujeto a estos Términos y Condiciones. Si no está de acuerdo con alguna parte de estos términos, no debe utilizar el Sitio.
    </p>

    <h2>2. Modificaciones</h2>
    <p>
        Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento. Las modificaciones serán efectivas una vez publicadas en el Sitio. Es su responsabilidad revisar periódicamente estos términos.
    </p>

    <h2>3. Uso del Sitio</h2>
    <ul>
        <li>Debe tener al menos 18 años o contar con el consentimiento de sus padres o tutores para utilizar el Sitio.</li>
        <li>No puede utilizar el Sitio para fines ilegales o no autorizados.</li>
        <li>Debe proporcionar información veraz y actualizada al registrarse o realizar compras.</li>
    </ul>

    <h2>4. Compras y Pagos</h2>
    <ul>
        <li>Al realizar una compra, acepta proporcionar información válida y autoriza el cobro correspondiente.</li>
        <li>Nos reservamos el derecho de rechazar o cancelar pedidos en cualquier momento por motivos justificados.</li>
        <li>Los precios y la disponibilidad de los productos pueden cambiar sin previo aviso.</li>
    </ul>

    <h2>5. Propiedad Intelectual</h2>
    <p>
        Todo el contenido del Sitio, incluidos textos, imágenes, logotipos y software, es propiedad de Nate Gentile - Tienda oficial o de sus licenciantes y está protegido por las leyes de propiedad intelectual. No puede copiar, reproducir o distribuir ningún contenido sin autorización expresa.
    </p>

    <h2>6. Limitación de Responsabilidad</h2>
    <p>
        No garantizamos que el Sitio esté libre de errores o interrupciones. En la medida permitida por la ley, no seremos responsables por daños directos, indirectos o consecuentes derivados del uso o la imposibilidad de uso del Sitio.
    </p>

    <h2>7. Enlaces a Terceros</h2>
    <p>
        El Sitio puede contener enlaces a sitios web de terceros. No somos responsables del contenido ni de las prácticas de privacidad de dichos sitios.
    </p>

    <h2>8. Protección de Datos</h2>
    <p>
        El tratamiento de sus datos personales se rige por nuestra <a href="{{ route('policy') }}" style="color:#1D7129;">Política de Privacidad</a>.
    </p>

    <h2>9. Ley Aplicable</h2>
    <p>
        Estos Términos y Condiciones se rigen por las leyes de España. Cualquier disputa será resuelta ante los tribunales competentes de España.
    </p>

    <h2>10. Contacto</h2>
    <p>
        Si tiene preguntas sobre estos Términos y Condiciones, puede contactarnos a través del formulario de contacto disponible en el Sitio.
    </p>
</div>
@endsection