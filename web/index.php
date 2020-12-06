<table width="1350px"border="1" bgcolor="red" >
	<tr>
		<td width="1350px"align="center"
		style='font-size: 40px; font-weight: bold'>Foro TacodeTeam</td>
			
	</tr>
</table>
<br>	<br>
<table width="1350px" bgcolor="green" border = 1>
	<tr>
		
		<td width="300px"align="center" BGCOLOR="#FF66FF">Autor</td>
		<td width="700px"align="center" BGCOLOR="#00cccc">Título</td>
		<td width="300px"align="center" BGCOLOR="#FFff99">Fecha</td>
		<td width="300px"align="center" BGCOLOR="#00FF00">Respuestas</td>
		<td width="200px"align="center" BGCOLOR="#00FF99"></td>
	</tr>
<?php 
	include("conexionBD.php");
	$query = "SELECT * FROM  foro WHERE identificador = 0 ORDER BY fecha DESC";
	$result = $mysqli->query($query);//tira error al loguearse
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id = $row['ID'];
		$autor= $row['autor'];
		$titulo = $row['titulo'];
		$fecha = $row['fecha'];
		$respuestas = $row['respuestas'];
		echo "<tr>";
		echo "<td align = center>$autor</td>";
		echo "<td align = center>$titulo</td>";
		echo "<td align = center>".date("d-m-y,$fecha")."</td>";
		echo "<td align = center>$respuestas</td>";
		echo "<td><a href='foro.php?id=$id'>ver</a></td>";
		echo "</tr>";
	}
?>
</table>
<br><br>
<a href="formulario.php"> Nuevo Tema </a>

