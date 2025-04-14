<!-- Sidebar -->
<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if ( Auth::user()->file_name )
                        <img  alt="{{ Auth()->user()->name }} " class="avatar-img rounded-circle"
                            src="{{ url('') }}/{{Auth()->user()->file_path}}/{{ Auth()->user()->file_name }}" width="128" height="128" id="img">
                    @else
                        <img  alt="{{ Auth()->user()->name }}" class="avatar-img rounded-circle"
                            src="{{ asset('templates/dashboard/assets/img/profile.jpg') }}" width="128" height="128" id="img">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->getRole()->group }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('backend.profile') }}">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('backend.change_password') }}">
                                    <span class="link-collapse">@lang('Change Password')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <?php	
                    if(! function_exists('display_tree')) {
                        function display_tree($nodes, $indent=0) {
                            if ($indent >= 20) return;	// Stop at 20 sub levels
                            
                            foreach ($nodes as $node) {
                                $url = url($node['url']);
                                $route = $node['route'];
                                $icon = $node['icon'];
                                $name = $node['name'];
                                $isActive = '';
                                if(Route::current()->getName() == $route) 
                                    $isActive = 'active';
                                
                                if ($url != "#")
                                    echo "<li class='nav-item $isActive'>
                                        <a href='$url'>
                                            <i class=$icon></i>
                                            <p>$name</p>
                                        </a>
                                    </li>";
                                else {
                                    echo "<li class='nav-item $isActive'>";
                                    echo "<a data-toggle='collapse' href='#$name'>
                                        <i class=$icon></i>
                                        <p>$name</p>
                                        <span class='caret'></span>
                                    </a>";
                                }

                                if (isset($node['children'])){                                    
                                    echo "<div class='collapse' id='$name'>";
								    echo "<ul class='nav nav-collapse'>";
                                    display_tree($node['children'],$indent+1);
                                    echo "</ul>";
                                    echo "</div>";
                                }
                                echo "</li>";
                            }
                        }
                    }
                    if(! function_exists('mapTree')) {
                        function mapTree($dataset) {
                            $tree = array();
                            foreach ($dataset as $id=>&$node) {
                                if ($node['parent'] === 0) {
                                    $tree[$id] = &$node;
                                } else {
                                    if (!isset($dataset[$node['parent']]['children'])) $dataset[$node['parent']]['children'] = array();
                                    $dataset[$node['parent']]['children'][$id] = &$node;
                                }
                            }
                            
                            return $tree;
                        }
                    }
					
					$dataset = array();
					foreach ($menu as $data){
						$dataset[$data->id] = array('parent' => $data->parent_id, 'name'=>$data->name, 'url'=>$data->uri, 'route'=>$data->route, 'icon'=>$data->icon); 
					} 
					$tree = mapTree($dataset);
					display_tree($tree); //show tree menu sidebar
				?>	
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
