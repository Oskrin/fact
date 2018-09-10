<?php 
if(!isset($_SESSION))
    {
        session_start();        
    }
/**
* 
*/
class menu
{
	
	function lateral(){
		$actual_link = "$_SERVER[REQUEST_URI]";
		$uri_=explode('/', $actual_link);

		print'
				<aside id="menu">
				    <div id="navigation">
				        <div class="profile-picture">
				            <a href="index-2.html">
				                <img src="../../images/profile.jpg" class="img-circle m-b" alt="logo">
				            </a>

				            <div class="stats-label text-color">
				                <span class="font-extra-bold font-uppercase">'.$_SESSION['fulldataadmin'][1].'</span>

				                <div class="dropdown">
				                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
				                        <small class="text-muted">Administrado<b class="caret"></b></small>
				                    </a>
				                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
				                        <li><a href="profile.html">Perfil</a></li>
				                        <li class="divider"></li>
				                        <li><a href="../exit/">Salir</a></li>
				                    </ul>
				                </div>
				            </div>
				        </div>

				        <ul class="nav" id="side-menu">

				            <li ';if($uri_[4]=='inicio')print 'class="active"';print'>
				                <a href="../inicio/">
				                	<span class="nav-label">Inicio</span>
				                	<span class="glyphicon glyphicon-home pull-right"></span>
				                </a>
				            </li>
				            <li ';
				            	if(
				            		$uri_[4]=='lugares_turisticos'||
				            		$uri_[4]=='establecimiento'||
				            		$uri_[4]=='parroquias'||
				            		$uri_[4]=='clima'||
				            		$uri_[4]=='tipo_lugares'||
				            		$uri_[4]=='tipo_establecimiento' ||
				            		$uri_[4]=='mapa' ||
				            		$uri_[4]=='eventos' ||
				            		$uri_[4]=='rutas_trazadas'
				            	){
				            		print 'class="active"';
				            	}
				            	print'>
				                <a href="#">
				                	<span class="nav-label">Registros</span>
				                	<span class="fa arrow pull-right"></span>
				                	<span class="glyphicon glyphicon-list-alt pull-right"></span>
				                </a>
				                <ul class="nav nav-second-level">

				                 <li ';if($uri_[4]=='lugares_turisticos')print 'class="active"';print'>
				                    	<a href="../lugares_turisticos/">Lugares Turisticos</a>
				                    </li>		

				                    <li ';if($uri_[4]=='establecimiento')print 'class="active"';print'>
				                    	<a href="../establecimiento/">Establecimientos</a>
				                    </li>

				                    <li ';if($uri_[4]=='parroquias')print 'class="active"';print'>
				                    	<a href="../parroquias/">Parroquias</a>
				                    	</li>
				                    <li ';if($uri_[4]=='clima')print 'class="active"';print'>
				                    	<a href="../clima/">Clima</a>
				                    </li>
				                    <li ';if($uri_[4]=='tipo_lugares')print 'class="active"';print'>
				                    	<a href="../tipo_lugares/">Tipo Lugares Turí..</a>
				                    </li>
				                   		               
				                    <li ';if($uri_[4]=='tipo_establecimiento')print 'class="active"';print'>
				                    	<a href="../tipo_establecimiento/">Tipo de Estable...</a>
				                    </li>

				                    <li ';if($uri_[4]=='eventos')print 'class="active"';print'>
				                    	<a href="../eventos/">Eventos</a>
				                    </li>

				                    <li ';if($uri_[4]=='rutas_trazadas')print 'class="active"';print'>
				                    	<a href="../rutas_trazadas/">Rutas Trazadas</a>
				                    </li>
				                    
				                </ul>
				            </li>
				            <li ';if($uri_[4]=='mapa')print 'class="active"';print'>
				                <a href="../mapa/">
				                	<span class="nav-label">Mapa</span>
				                	<span class="glyphicon glyphicon-globe pull-right danger"></span>
				                </a>
				            </li>

				            <li ';
				            	print'>
				                <a href="#">
				                	<span class="nav-label">Reportes</span>
				                	<span class="fa arrow pull-right"></span>
				                	<span class="glyphicon glyphicon-print pull-right"></span>
				                </a>
				                <ul class="nav nav-second-level">
				                 	<li ';if($uri_[4]=='turistas')print 'class="active"';print'>
				                    	<a href="../reportes/turistas.php" target="_new">Turistas</a>
				                    </li>

				                    <li ';if($uri_[4]=='turistas')print 'class="active"';print'>
				                    	<a href="../reportes/lugares.php" target="_new">Lugares Turisticos</a>
				                    </li>

				                    <li ';if($uri_[4]=='turistas')print 'class="active"';print'>
				                    	<a href="../reportes/establecimientos.php" target="_new">Establecimientos</a>
				                    </li>  
				                </ul>
				            </li>
				        </ul>
				    </div>
				</aside>

		';
	}
}
?>