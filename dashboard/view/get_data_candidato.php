<?php
require_once('../controller/conec.php');
$conn = new mysqli($servername, $username, $password, $dbname);
$result ='';
if( $conn->connect_errno )
{
  echo '';
  exit;
}

// Obtener datos del año en curso y del año anterior
$sql = "SELECT 
            COUNT(id_beneficiario) as idempr, 
            MONTH(dt_fh_registro) as month,
            YEAR(dt_fh_registro) as year
        FROM beneficiario 
        WHERE YEAR(dt_fh_registro) IN (YEAR(CURDATE()), YEAR(CURDATE()) - 1)
        GROUP BY YEAR(dt_fh_registro), MONTH(dt_fh_registro)";
$result = $conn->query($sql);

// Inicializar arrays para datos
$labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$currentYearData = array_fill(1, 12, 0);
$previousYearData = array_fill(1, 12, 0);

// Procesar datos y almacenar en arrays por año
while ($row = $result->fetch_assoc()) {
    $month = $row['month'];
    $idempr = $row['idempr'];
    $year = $row['year'];

    if ($year == date('Y')) {
        $currentYearData[$month] = $idempr;
    } elseif ($year == date('Y') - 1) {
        $previousYearData[$month] = $idempr;
    }
}

// Construir array de datos para enviar al cliente
$chartData = [
    'labels' => $labels,
    'datasets' => [
        [
            'label' => 'Año Actual',
            'data' => array_values($currentYearData)
        ],
        [
            'label' => 'Año Anterior',
            'data' => array_values($previousYearData)
        ]
    ]
];

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($chartData);

// Cerrar la conexión
$conn->close();
?>
