@extends('layout.default')
@php 
$urlContent = url()->current();
@endphp
@section('content')
<div id="hwpwrap">
	<div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
		<div id="wpwrap">
			<div id="wpcontent">
				<div id="wpbody">
					<div id="wpbody-content">
						<div class="wrap">
							<div class="manage-menus">
								<form method="get" action="{{ $urlContent }}">
									<label for="menu" class="selected-menu">Select the menu you want to edit:</label>
									{!! Applib::select('menu', $menulist) !!}
									<span class="submit-btn">
										<input type="submit" class="button-secondary" value="Choose">
									</span>
									<span class="add-new-menu-action"> or <a href="{{ $urlContent }}?action=edit&menu=0">Buat Menu Baru</a>. </span>
								</form>
							</div>
							<div id="nav-menus-frame">
								@if(request()->has('menu') && !empty(request()->input("menu")))
								<div id="menu-settings-column" class="metabox-holder">
									<div class="clear"></div>
									<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  open add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="menu-item-url-wrap">
																	<label class="howto" for="custom-menu-item-opsi"> <span>Source</span>&nbsp;
																		<select id="custom-menu-item-opsi" name="custom-menu-item-opsi">
																			<option value="1">Link Internal</option>
																			<option value="2">Link Eskternal</option>
																		</select>
																	</label>
																</p>

																<p id="menu-item-url-wrap">
																	<label class="howto" for="custom-menu-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
																		<input id="custom-menu-item-url" name="url" type="text" class="menu-item-textbox " placeholder="url">
																	</label>
																</p>

																<p id="menu-item-name-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Label</span>&nbsp;
																		<input id="custom-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
																	</label>
																</p>

																@if(!empty($roles))
																<p id="menu-item-role_id-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Role</span>&nbsp;
																		<select id="custom-menu-item-role" name="role">
																			<option value="0">Select Role</option>
																			@foreach($roles as $role)
																			<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																			@endforeach
																		</select>
																	</label>
																</p>
																@endif

																<p class="button-controls">
																	<a href="#" onclick="addcustommenu()" class="button-secondary submit-add-to-menu right">Add menu item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>
												<li class="control-section accordion-section add-pages" id="add-pages">
													<h3 class="accordion-section-title hndle" tabindex="1"> Halaman<span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="pageslinkdiv" id="pageslinkdiv">
																<table class="table  table-bordered ">
																	{!! Applib::menupage() !!}
																</table>

																@if(!empty($roles))
																<p id="menu-item-role_id-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Role</span>&nbsp;
																		<select id="custom-menu-item-role" name="role">
																			<option value="0">Select Role</option>
																			@foreach($roles as $role)
																			<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																			@endforeach
																		</select>
																	</label>
																</p>
																@endif
															</div>
														</div>
													</div>
												</li>
												<li class="control-section accordion-section add-kat" id="add-kat">
													<h3 class="accordion-section-title hndle" tabindex="1"> Kategori<span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="kategorilinkdiv" id="kategorilinkdiv">
																<table class="table  table-bordered ">
																	{!! Applib::menukategori() !!}
																</table>

																@if(!empty($roles))
																<p id="menu-item-role_id-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Role</span>&nbsp;
																		<select id="kategori-menu-item-role" name="role">
																			<option value="0">Select Role</option>
																			@foreach($roles as $role)
																			<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																			@endforeach
																		</select>
																	</label>
																</p>
																@endif
															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>

								</div>
								@endif
								<div id="menu-management-liquid">
									<div id="menu-management">
										<form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
											<div class="menu-edit ">
												<div id="nav-menu-header">
													<div class="major-publishing-actions">
														<label class="menu-name-label howto open-label" for="menu-name"> <span>Name</span>
															<input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
															<input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
														</label>

														@if(request()->has('action'))
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														@elseif(request()->has("menu"))
														<div class="publishing-action">
															<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
															<span class="spinner" id="spincustomu2"></span>
														</div>

														@else
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														@endif
													</div>
												</div>
												<div id="post-body">
													<div id="post-body-content">

														@if(request()->has("menu"))
														<h3>Menu Structure</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
															</p>
														</div>

														@else
														<h3>Buat Menu</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Silakan masukkan nama dan pilih tombol "Buat menu"
															</p>
														</div>
														@endif

														<ul class="menu ui-sortable" id="menu-to-edit">
															@if(isset($menus))
															@foreach($menus as $m)
															<li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
																<dl class="menu-item-bar">
																	<dt class="menu-item-handle">
																		<span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span> <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span> </span>
																		<span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{ $urlContent }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $urlContent }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$m->id}}" title=" " href="{{ $urlContent }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
																	</dt>
																</dl>

																<div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
																	<input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
																	<p class="description description-thin">
																		<label for="edit-menu-item-title-{{$m->id}}"> Label
																			<br>
																			<input type="text" id="idlabelmenu_{{$m->id}}" class="widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}">
																		</label>
																	</p>

																	<p class="field-css-classes description description-thin">
																		<label for="edit-menu-item-classes-{{$m->id}}"> Class CSS (optional)
																			<br>
																			<input type="text" id="clases_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}">
																		</label>
																	</p>

																	<p class="field-css-url description description-wide">
																		<label for="edit-menu-item-url-{{$m->id}}"> Url
																			<br>
																			<input type="text" id="url_menu_{{$m->id}}" class="widefat code edit-menu-item-url" id="url_menu_{{$m->id}}" value="{{$m->link}}">
																		</label>
																	</p>

																	@if(!empty($roles))
																	<p class="field-css-role description description-wide">
																		<label for="edit-menu-item-role-{{$m->id}}"> Role
																			<br>
																			<select id="role_menu_{{$m->id}}" class="widefat code edit-menu-item-role" name="role_menu_[{{$m->id}}]">
																				<option value="0">Select Role</option>
																				@foreach($roles as $role)
																				<option @if($role->id == $m->role_id) selected @endif value="{{ $role->$role_pk }}">{{ ucwords($role->$role_title_field) }}</option>
																				@endforeach
																			</select>
																		</label>
																	</p>
																	@endif

																	<p class="field-move hide-if-no-js description description-wide">
																		<label> <span>Move</span> <a href="{{ $urlContent }}" class="menus-move-up" style="display: none;">Move up</a> <a href="{{ $urlContent }}" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="{{ $urlContent }}" class="menus-move-left" style="display: none;"></a> <a href="{{ $urlContent }}" class="menus-move-right" style="display: none;"></a> <a href="{{ $urlContent }}" class="menus-move-top" style="display: none;">Top</a> </label>
																	</p>

																	<div class="menu-item-actions description-wide submitbox">

																		<a class="item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{ $urlContent }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Delete</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{$m->id}}" href="{{ $urlContent }}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">Cancel</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a onclick="getmenus()" class="button button-primary updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Update item</a>

																	</div>

																</div>
																<ul class="menu-item-transport"></ul>
															</li>
															@endforeach
															@endif
														</ul>
														<div class="menu-settings">

														</div>
													</div>
												</div>

											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" integrity="sha512-4uGZHpbDliNxiAv/QzZNo/yb2FtAX+qiDb7ypBWiEdJQX8Pugp8M6il5SRkN8jQrDLWsh3rrPDSXRf3DwFYM6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset('public/css/menu/stylemenu.css')}}" rel="stylesheet">
@stop

@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" integrity="sha512-4uGZHpbDliNxiAv/QzZNo/yb2FtAX+qiDb7ypBWiEdJQX8Pugp8M6il5SRkN8jQrDLWsh3rrPDSXRf3DwFYM6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('public/js/menu/scripts.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/menu/scripts2.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/menu/menu.js') }}"></script>
	<script>
		var menus = {
			"oneThemeLocationNoMenus" : "",
			"moveUp" : "Move up",
			"moveDown" : "Mover down",
			"moveToTop" : "Move top",
			"moveUnder" : "Move under of %s",
			"moveOutFrom" : "Out from under  %s",
			"under" : "Under %s",
			"outFrom" : "Out from %s",
			"menuFocus" : "%1$s. Element menu %2$d of %3$d.",
			"subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
		};
		var arraydata = [];     
		var addcustommenur= '{{ route("haddcustommenu") }}';
		var updateitemr= '{{ route("hupdateitem")}}';
		var generatemenucontrolr= '{{ route("hgeneratemenucontrol") }}';
		var deleteitemmenur= '{{ route("hdeleteitemmenu") }}';
		var deletemenugr= '{{ route("hdeletemenug") }}';
		var createnewmenur= '{{ route("hcreatenewmenu") }}';
		var csrftoken="{{ csrf_token() }}";
		var menuwr = "{{ url()->current() }}";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': csrftoken
			}
		});
	</script>
@stop