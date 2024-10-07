Formatos de devolucion o posteo para los end points de la api:

1. POST /api/login

{
  "email": "usuario@ejemplo.com",
  "password": "contraseña123"
}

2. POST /api/register

{
  "name": "Nuevo Usuario",
  "email": "nuevo@ejemplo.com",
  "password": "contraseña123",
  "password_confirmation": "contraseña123",
  "role": "user"
}

3. GET /api/inventario

No requiere cuerpo JSON. La respuesta podría ser algo como:

[
  {
    "id": 1,
    "tipo_recurso": "Computadora",
    "area": "Sistemas",
    "especialidad": "Desarrollo",
    "tipo_equipo": "Laptop",
    "marca": "Dell",
    "modelo": "XPS 15",
    "procesador": "Intel Core i7",
    "ram": "16GB",
    "disco_duro": "512GB SSD",
    "serie": "ABC123XYZ",
    "cod_patrimonial": "PAT-001-2023",
    "estado": "Activo",
    "ubicacion": "Oficina Principal",
    "personal": "Juan Pérez",
    "observaciones": "Equipo en excelentes condiciones"
  },
  {
    "id": 2,
    "tipo_recurso": "Impresora",
    "area": "Administración",
    "especialidad": "Contabilidad",
    "tipo_equipo": "Multifuncional",
    "marca": "HP",
    "modelo": "OfficeJet Pro 9015",
    "procesador": "N/A",
    "ram": "N/A",
    "disco_duro": "N/A",
    "serie": "XYZ987ABC",
    "cod_patrimonial": "PAT-002-2023",
    "estado": "En mantenimiento",
    "ubicacion": "Sala de Impresión",
    "personal": "María Rodríguez",
    "observaciones": "Necesita recarga de tinta"
  }
]

4. POST /api/inventario

{
  "tipo_recurso": "Computadora",
  "area": "Sistemas",
  "especialidad": "Desarrollo",
  "tipo_equipo": "Laptop",
  "marca": "Dell",
  "modelo": "XPS 15",
  "procesador": "Intel Core i7",
  "ram": "16GB",
  "disco_duro": "512GB SSD",
  "serie": "ABC123XYZ",
  "cod_patrimonial": "PAT-001-2023",
  "estado": "Nuevo",
  "ubicacion": "Oficina Principal",
  "personal": "Juan Pérez",
  "observaciones": "Equipo nuevo en excelentes condiciones"
}

5. GET /api/inventario/{id}

No requiere cuerpo JSON. La respuesta para /api/inventario/1 podría ser:

{
  "id": 1,
  "tipo_recurso": "Computadora",
  "area": "Sistemas",
  "especialidad": "Desarrollo",
  "tipo_equipo": "Laptop",
  "marca": "Dell",
  "modelo": "XPS 15",
  "procesador": "Intel Core i7",
  "ram": "16GB",
  "disco_duro": "512GB SSD",
  "serie": "ABC123XYZ",
  "cod_patrimonial": "PAT-001-2023",
  "estado": "Nuevo",
  "ubicacion": "Oficina Principal",
  "personal": "Juan Pérez",
  "observaciones": "Equipo nuevo en excelentes condiciones"
}

6. PUT /api/inventario/{id}

Se modifica uno de los campos de la tabla inventario

{
  "tipo_recurso": "Computadora",
  "area": "Sistemas",
  "especialidad": "Desarrollo",
  "tipo_equipo": "Laptop",
  "marca": "Dell",
  "modelo": "XPS 15",
  "procesador": "Intel Core i7",
  "ram": "16GB",
  "disco_duro": "512GB SSD",
  "serie": "ABC123XYZ",
  "cod_patrimonial": "PAT-001-2023",
  "estado": "Nuevo",
  "ubicacion": "Oficina Principal",
  "personal": "Juan Pérez",
  "observaciones": "Equipo nuevo en excelentes condiciones"
}

7. DELETE /api/inventario/{id}

No requiere cuerpo JSON. La respuesta podría ser:

{
  "message": "Recurso eliminado correctamente"
}
