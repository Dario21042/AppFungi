const express = require('express');
const app = express();
const port = 3000;

// Manejar solicitudes GET a la ruta /search
app.get('/search', (req, res) => {
  const searchTerm = req.query.term;

  // Simulación de resultados de búsqueda
  const mockResults = [
    { name: 'Hongo A', description: 'Descripción del Hongo A' },
    { name: 'Hongo B', description: 'Descripción del Hongo B' },
    { name: 'Hongo C', description: 'Descripción del Hongo C' }
  ];

  // Filtrar los resultados de búsqueda según el término de búsqueda
  const filteredResults = mockResults.filter(result => result.name.toLowerCase().includes(searchTerm.toLowerCase()));

  // Devolver los resultados como JSON
  res.json({ results: filteredResults });
});

// Servir archivos estáticos desde la carpeta "public"
app.use(express.static('public'));

// Iniciar el servidor
app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});
