<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="<?=get_foto_perfil_sesion($sesion['foto'])?>" alt="user" /><span class="hide-menu"><?=$sesion['razon_social'].' '.$sesion['apellidos']?> </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void()">Notificaciones</a></li>
                                <li><a href="javascript:void()">Mi perfil </a></li>
                                <li><a href="salir.php">Salir</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Ministros</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="ministro-registrar.php">Registrar Ministro </a></li>
                                <li><a href="ministro-editar.php">Editar Ministro</a></li>
                                <li><a href="ministro-ver.php">Ver Ministros</a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-church"></i><span class="hide-menu">Iglesias</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#">Registrar Iglesia </a></li>
                                <li><a href="#">Editar Iglesia</a></li>
                                <li><a href="#">Ver Iglesia</a></li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>