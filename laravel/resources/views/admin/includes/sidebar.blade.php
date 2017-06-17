<aside class="left-side sidebar-offcanvas " >
    <section class="sidebar ">
        <div class="page-sidebar sidebar-nav">
            <div class="nav_icons">
                <ul class="sidebar_threeicons">
                    <li>
                        <a href="form_builder.html">
                            <i class="livicon" data-name="hammer" title="Form Builder 1" data-loop="true"
                               data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="form_builder2.html">
                            <i class="livicon" data-name="list-ul" title="Form Builder 2" data-loop="true"
                               data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="buttonbuilder.html">
                            <i class="livicon" data-name="vector-square" title="Button Builder" data-loop="true"
                               data-color="#f6bb42" data-hc="#f6bb42" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="gridmanager.html">
                            <i class="livicon" data-name="new-window" title="Form Builder 1" data-loop="true"
                               data-color="#37bc9b" data-hc="#37bc9b" data-s="25"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <!-- BEGIN SIDEBAR MENU -->
            <ul id="menu" class="page-sidebar-menu">
                <li>
                    <a href="{{url('home')}}">
                        <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                           data-loop="true"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>


                @if(Auth::user()->type=='super')
                    <li>
                        <a href="#" id="a-admin">
                            <i class="livicon" data-name="medal" data-size="18" data-c="#00bc8c" data-hc="#00bc8c"
                               data-loop="true"></i>
                            <span class="title">Administración</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('admin/categorias')}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Categorias
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/subcategorias')}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Subcategorias
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/cursos')}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Cursos
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/usuarios')}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Usuarios
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </section>
</aside>