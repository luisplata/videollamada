define({ "api": [
  {
    "type": "Method",
    "url": "/api/plantilla/",
    "title": "Plantilla para la documentación",
    "group": "Plantilla",
    "description": "<p>Aquí se explica que hace el recurso con varias lineas</p>",
    "version": "0.1.0",
    "examples": [
      {
        "title": "Ejemplo de Uso:",
        "content": "https://quehaypahacer.nabu.com.co/api/plantilla/{Tipo:parametro_get}",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "Parametro",
            "description": "<p>Parametro (POST|PUT|DELECT) en la petición.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Tipo",
            "optional": false,
            "field": "nombre",
            "description": "<p>descripcion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Ejemplo de Éxito:",
          "content": "HTTP/1.1 200 OK\n{\n    \"mensaje\":\"Esto es el ejemplo de todo OK\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "EjemploSoloParaBusquedas"
      }
    ],
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Codigo1",
            "description": "<p>Descripcion <code>4xx</code> y una corta explicación.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Codigo2",
            "description": "<p>Descripcion <code>4xx</code> y una explicación.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "501",
            "description": "<p>Usualmente para cuando es error de Base de datos, de duplicado, requerido, violacion de llave foranea.</p>"
          }
        ]
      }
    },
    "filename": "routes/api.php",
    "groupTitle": "Plantilla",
    "name": "MethodApiPlantilla"
  },
  {
    "type": "POST",
    "url": "/api/empresa/registrar",
    "title": "Recurso para registrar una empresa desde afuera",
    "group": "Registro_y_Control",
    "description": "<p>Cuando un sistema externo desea registrar sus usuarios internamente. Puede hacerlo mediante este recurso</p>",
    "version": "0.1.0",
    "examples": [
      {
        "title": "Ejemplo de Uso:",
        "content": "https://videollamada.nabu.com.co/api/empresa/registro",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nombre",
            "description": "<p><strong>maxlength:190</strong> | <strong>Required</strong></p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p><strong>maxlength:190</strong> | <strong>Required</strong> | <strong>Unique</strong></p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "telefono",
            "description": "<p><strong>maxlength:190</strong></p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pass",
            "description": "<p><strong>maxlength:190</strong> | <strong>Required</strong> <strong>Pasword de la plataforma</strong></p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token del registro nuevo</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Ejemplo de Éxito:",
          "content": "HTTP/1.1 200 OK\n{\n    token:\"$gd7689768&8ihji&hnoonofe\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "https://videollamada.nabu.com.co/api/empresa/registro"
      }
    ],
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "513",
            "description": "<p>No se pudo Guardar la información</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "514",
            "description": "<p>Error de validación.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "501",
            "description": "<p>Usualmente para cuando es error de Base de datos, de duplicado, requerido, violacion de llave foranea.</p>"
          }
        ]
      }
    },
    "filename": "routes/api.php",
    "groupTitle": "Registro_y_Control",
    "name": "PostApiEmpresaRegistrar"
  },
  {
    "type": "POST",
    "url": "/api/obtener/url",
    "title": "Consulta de url para la videollamada",
    "group": "Videollamada",
    "description": "<p>Para acceder desde otra aplicación debe consultar la url en esta dirección, para asi entrar desde cualquier sitio con esa URL.</p>",
    "version": "0.1.0",
    "examples": [
      {
        "title": "Ejemplo de Uso:",
        "content": "https://videollamada.nabu.com.co/api/obtener/url",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>Token de la empresa que se creo al registrarse.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "URL",
            "description": "<p>Url completa de la sala de la videollamada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Ejemplo de Éxito:",
          "content": "HTTP/1.1 200 OK\n{\n    \"url\":\"https://videollamada.nabu.com.co/videollamada?sala=SalaVideollamada&nombre=\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "https://videollamada.nabu.com.co/api/obtener/url"
      }
    ],
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403",
            "description": "<p>Token no valido.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "502",
            "description": "<p>No se creo la sala, volver a intentarlo</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "501",
            "description": "<p>Usualmente para cuando es error de Base de datos, de duplicado, requerido, violacion de llave foranea.</p>"
          }
        ]
      }
    },
    "filename": "routes/api.php",
    "groupTitle": "Videollamada",
    "name": "PostApiObtenerUrl"
  }
] });
