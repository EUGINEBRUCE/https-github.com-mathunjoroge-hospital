<%@ page language="java" contentType="text/html; charset=utf-8"
    pageEncoding="utf-8"%>
<%@ page import="com.neusoft.micia.model.MiciaUserDetail"%>
<%@ page import="org.springframework.security.core.context.SecurityContextHolder"%>
<%@ taglib prefix="sec" uri="http://www.springframework.org/security/tags"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%
//jsp页面不缓存
response.setHeader("Pragma","No-cache");
response.setHeader("Cache-Control","no-cache");
response.setDateHeader("Expires", 0);
%>
<%
String flag = (String)request.getSession().getAttribute("cloudFunDeleteFlag");
MiciaUserDetail userDetail = (MiciaUserDetail) SecurityContextHolder.getContext().getAuthentication().getPrincipal();
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<spring:url value="/scripts" htmlEscape="true" var="scripts"></spring:url>
<jsp:include page="./micia_header.jsp"></jsp:include>
<style type="text/css">
	#north a {
		width: 100px;
		height: 33px;
	}
	#north a span {
	}
	.west-div {
		width: 276px;
		margin-left: 12px; 
		margin-top: 12px;
		overflow: hidden;
	}
	.west-div-span1, .west-fieldset-span1 {
		float: left; 
		width: 100px;
		margin-top: 2px;
	}
	.west-div-span2 {
		float: left; 
		width: 110px;
	}
	.west-div a {
		width: 80px;
	}
	#hs {
		width: 220px;
		margin-left: 12px; 
		margin-top: 12px;
		overflow: hidden;
		text-decoration: underline;
		cursor: pointer;
	}
	.west-fieldset {
		width: 270px;
		margin-left: 12px; 
		margin-top: 12px;
		overflow: hidden;
		display: none;
	}
	.west-fieldset div {
		width: 239px;
		margin-top: 12px;
		overflow: hidden;
	}
	.west-fieldset-span2 {
		float: left; 
		width: 130px;
	}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 
<!-- BEGIN HEADER -->
<jsp:include page="./micia_top_menu.jsp"></jsp:include>
<!-- END HEADER -->
<div class="clearfix">
</div>
<div class="studyList1"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container page-sidebar-reversed">
    
	<!-- BEGIN SIDEBAR -->
    <jsp:include page="./micia_navi_right.jsp"></jsp:include>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	
	<div class="page-content-wrapper">
		<div class="page-content">
			<div id="assistModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title"><spring:message code="main.assistModal.modal-title"/></h4>
						</div>
						<div class="modal-body">
							<div class="scroller" style="height:380px;" data-always-visible="1" data-rail-visible1="1">
								    <div class="portlet box green-haze" style="margin-bottom: 0;">
										<div class="portlet-title">
											<ul class="nav nav-tabs">
		 										<li class="active">
		 											<a href="#assist_portlet_tab2" data-toggle="tab"><spring:message code="patient_manager.west.assistlocal"/></a>
		 										</li>
		 										<% if("0".equals(flag)){ %>
												<li>
													<a href="#assist_portlet_tab1" data-toggle="tab"><spring:message code="patient_manager.west.assistcloud"/></a>
												</li>
												<% } %>
												<li>
		 											<a href="#assist_portlet_tab3" data-toggle="tab"><spring:message code="patient_manager.west.assistfenzhen"/></a>
		 										</li>
											</ul>
										</div>
										<div class="portlet-body">
											<div class="tab-content">
												<div class="tab-pane" id="assist_portlet_tab3">
													<div class="tiles" style="margin: 0; height: 310px; overflow: auto;">
														<div class="col-md-6">
															<h4><spring:message code="main.assistModal.modal-body.h4-1"/></h4>
															<img id="patientIMG" src=''/>
															</br>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.patientName"/>
																<input id="patientName3" type="text" class="col-md-6 form-control" disabled="true">
																</input>
															</p>
															<p>
																<spring:message code="main.assistModal.modal-body.patientSex"/>
																<input id="patientSex3" type="text" class="col-md-6 form-control" disabled="true">
															</p>
															<p>
																<spring:message code="main.assistModal.modal-body.patientAge"/>
																<input id="patientAge3" type="text" class="col-md-6 form-control" disabled="true">
															</p>
														</div>
														<div class="col-md-6">
															<h4><spring:message code="main.assistModal.modal-body.h4-2"/></h4>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.assistTargetUser"/>
																<select id="assistTargetUser3" type="text" class="col-md-12 form-control"></select>
															</p>
															</br>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.assistDesc"/>
																<textarea id="assistDesc3" maxlength="140" class="form-control" rows="3=6" placeholder="<spring:message code="main.assistModal.modal-body.assistDesc.placeholder"/>"></textarea>
																<span class="help-block">
																<spring:message code="main.assistModal.modal-body.help-block"/>
												                 </span>
															</p>
															</br>
															<p  style="display: none;">
																<spring:message code="main.assistModal.modal-body.reportAuth"/>
																<input type="checkbox" id="reportAuth3">
															</p>
															</br>
														</div>
													</div>
												</div>
												<div class="tab-pane active" id="assist_portlet_tab2">
													<div class="tiles" style="margin: 0; height: 310px; overflow: auto;">
														<div class="col-md-6">
															<h4><spring:message code="main.assistModal.modal-body.h4-1"/></h4>
															<img id="patientIMG" src=''/>
															</br>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.patientName"/>
																<input id="patientName" type="text" class="col-md-6 form-control" disabled="true">
																</input>
															</p>
															<p>
																<spring:message code="main.assistModal.modal-body.patientSex"/>
																<input id="patientSex" type="text" class="col-md-6 form-control" disabled="true">
															</p>
															<p>
																<spring:message code="main.assistModal.modal-body.patientAge"/>
																<input id="patientAge" type="text" class="col-md-6 form-control" disabled="true">
															</p>
														</div>
														<div class="col-md-6">
															<h4><spring:message code="main.assistModal.modal-body.h4-2"/></h4>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.assistTargetUser"/>
																<select id="assistTargetUser" type="text" class="col-md-12 form-control"></select>
															</p>
															</br>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.assistDesc"/>
																<textarea id="assistDesc" maxlength="140" class="form-control" rows="3=6" placeholder="<spring:message code="main.assistModal.modal-body.assistDesc.placeholder"/>"></textarea>
																<span class="help-block">
																<spring:message code="main.assistModal.modal-body.help-block"/>
												                 </span>
															</p>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.reportAuth"/>
																<input type="checkbox" id="reportAuth">
															</p>
															</br>
														</div>
													</div>
												</div>
		 										<div class="tab-pane" id="assist_portlet_tab1">
		 											<div class="tiles" style="margin: 0; width:4000px;height: 310px; overflow: auto;">
														<div class="col-md-6">
															<h4><spring:message code="main.assistModal.modal-body.h4-1"/></h4>
															<img id="patientIMG2" src=''/>
															</br>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.patientName"/>
																<input id="patientName2" type="text" class="col-md-6 form-control" disabled="true">
																</input>
															</p>
															<p>
																<spring:message code="main.assistModal.modal-body.patientSex"/>
																<input id="patientSex2" type="text" class="col-md-6 form-control" disabled="true">
															</p>
															<p>
																<spring:message code="main.assistModal.modal-body.patientAge"/>
																<input id="patientAge2" type="text" class="col-md-6 form-control" disabled="true">
															</p>
														</div>
														<div class="col-md-6">
															<h4><spring:message code="main.assistModal.modal-body.h4-2"/></h4>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.assistTargetUser"/>
																<select id="assistTargetUser2" type="text" class="col-md-12 form-control"></select>
															</p>
															</br>
															</br>
															<p>
																<spring:message code="main.assistModal.modal-body.assistDesc"/>
																<textarea id="assistDesc2" maxlength="140" class="form-control" rows="3=6" placeholder="<spring:message code="main.assistModal.modal-body.assistDesc.placeholder"/>"></textarea>
																<span class="help-block">
																<spring:message code="main.assistModal.modal-body.help-block"/>
												                 </span>
															</p>
															</br>
															<p style="display: none;">
																<spring:message code="main.assistModal.modal-body.reportAuth"/>
																<input type="checkbox" id="reportAuth2">
															</p>
															</br>
														</div>
													</div>
		 										</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-circle default "><spring:message code="button.cancel"/></button>
							<button type="submit" id="assistCfrmBtn" class="btn btn-circle green-haze"><spring:message code="button.ok"/></button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- 二维码模态窗口 -->
			<div id="qrcodeModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title"><spring:message code="main.qrcodeModal.modal-title"/></h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<center>
										<image id="qrcodeimg" src="">
										<br/><spring:message code="main.qrcodeModal.modal-body.notice"/>
									</center>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-circle default "><spring:message code="button.cancel"/></button>
						</div>
					</div>
				</div>
			</div>

		    <div class="change-btn-div">
		    	<sec:authorize ifAnyGranted="56, 68, 69, 70, 801, 802, 803">
					<button id="assist" class="btn btn-success"><spring:message code="patient_manager.button.assist"/></button>
				</sec:authorize>
				<button id="browser" class="btn btn-success"><spring:message code="patient_manager.button.2D"/></button>
				<button id="3dbrowser" class="btn btn-success"><spring:message code="patient_manager.button.3D"/></button>
				<button id="reportedit" class="btn btn-success"><spring:message code="patient_manager.button.report"/></button>
				<!-- 
				<sec:authorize ifAnyGranted="56, 68, 69, 70, 801, 802, 803">
					<button id="download" class="btn btn-success"><spring:message code="patient_manager.button.download"/></button>
				</sec:authorize>
				<% if("0".equals(flag)){ %>
				<button id="qrcode" class="btn btn-success"><spring:message code="patient_manager.button.qrcode"/></button>
				<button id="upload" class="btn btn-success"><spring:message code="patient_manager.button.upload"/></button>
				<% } %>
				 -->
				<button id="toNew" class="btn btn-success"><i class="fa fa-reply"></i> <spring:message code="patient_manager.button.switch"/></button>
			</div>

			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h4 class="page-title" style="font-size: 24px;">
			<spring:message code="patient_manager.page.title"/>
			</h4>
			
			<div class="easyui-layout" fit="true">
			
			<div id="west" region="west" title="<spring:message code="patient_manager.west.title"/>" style="overflow-Y:auto;overflow-X:hidden;width:330px;margin:0 auto;">
			
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.diagid"/></span>
					<span class="west-div-span2">
						<input id="diagid" name="diagid" type="text" style="width: 142px;" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.studyid"/></span>
					<span class="west-div-span2">
						<input id="studyid" name="studyid" type="text" style="width: 142px" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.departmentpatientid"/></span>
					<span class="west-div-span2">
						<input id="departmentpatientid" name="departmentpatientid" type="text" style="width: 142px" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.clinicpatientid"/></span>
					<span class="west-div-span2">
						<input id="clinicpatientid" name="clinicpatientid" type="text" style="width: 142px" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.infeepatientid"/></span>
					<span class="west-div-span2">
						<input id="infeepatientid" name="infeepatientid" type="text" style="width: 142px" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.patientname"/></span>
					<span class="west-div-span2">
						<input id="patientname" name="patientname" type="text" style="width: 142px" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div" style="display: none;">
					<span class="west-div-span1"><spring:message code="patient_manager.west.checkserialnum"/></span>
					<span class="west-div-span2">
						<input id="checkserialnum" name="checkserialnum" type="text" style="width: 142px" editable="false" class="easyui-edittext">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.devicetypename"/></span>
					<span class="west-div-span2">
						<input id="devicetypename" name="devicetypename" style="width: 148px; height:28px;">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.positiontypename"/></span>
					<span class="west-div-span2">
						<input id="positiontypename" name="positiontypename" type="text" style="width: 148px; height:28px;">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.checkitem"/></span>
					<span class="west-div-span2">
						<input id="checkitem" name="checkitem" type="text" style="width: 148px; height:28px;">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.studystatus"/></span>
					<span class="west-div-span2">
						<input id="studystatus" name="studystatus" type="text" style="width: 148px; height:28px;">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.studystarttime"/></span>
					<span class="west-div-span2">
						<input id="studystarttime" name="studystarttime" style="width: 148px; height:28px;" class="easyui-datebox">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.studyendtime"/></span>
					<span class="west-div-span2">
						<input id="studyendtime" name="studyendtime" style="width: 148px; height:28px;" class="easyui-datebox">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.ifemergency"/></span>
					<span class="west-div-span2">
						<input id="ifemergency" name="ifemergency" type="text" style="width: 148px; height:28px;">
					</span>
				</div>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.reportback"/></span>
					<span class="west-div-span2">
						<input id="ifRefuseReport" name="ifRefuseReport" type="text" style="width: 148px; height:28px;">
					</span>
				</div>
				<% if("0".equals(flag)){ %>
				<div class="west-div">
					<span class="west-div-span1"><spring:message code="patient_manager.west.ifUploadCloud"/></span>
					<span class="west-div-span2">
						<input id="ifUploadCloud" name="ifUploadCloud" type="checkbox" style="width: 148px; height:28px;">
					</span>
				</div>
				<% } %>
				<div class="west-div">
					&nbsp;<a href="#" id="querydata" class="easyui-linkbutton"><spring:message code="patient_manager.west.a.querydata"/></a>&nbsp;&nbsp;
					<a href="#" id="reset" class="easyui-linkbutton"><spring:message code="patient_manager.west.a.reset"/></a>
				</div>
				<div id="hs"><spring:message code="patient_manager.west.hs"/></div>
				<fieldset class="west-fieldset">
				<legend><spring:message code="patient_manager.west.patient.legend"/></legend>
					<div>
						<span class="west-fieldset-span1"><spring:message code="patient_manager.west.patient.hispatienttype"/></span>
						<span class="west-fieldset-span2">
							<input id="hispatienttype" name="hispatienttype" type="text" style="width: 128px;">
						</span>
					</div>
					<div>
						<span class="west-fieldset-span1"><spring:message code="patient_manager.west.patient.sex"/></span>
						<span class="west-fieldset-span2">
							<input id="sex" name="sex" type="text" style="width: 128px;">
						</span>
					</div>
					<div>
						<span class="west-fieldset-span1"><spring:message code="patient_manager.west.patient.age"/></span>
						<span class="west-fieldset-span2">
							<input id="age1" name="age1" type="text" style="width: 18px;">
							<span style="width: 12px;"><spring:message code="patient_manager.west.patient.to"/></span>
							<input id="age2" name="age2" type="text" style="width: 18px;">
							<input id="ageunit" name="ageunit" type="text" style="width: 52px;">
						</span>
					</div>
				</fieldset>
				<fieldset class="west-fieldset">
				<legend><spring:message code="patient_manager.west.doctor.legend"/></legend>
					<div>
						<span class="west-fieldset-span1"><spring:message code="patient_manager.west.doctor.doctor"/></span>
						<span class="west-fieldset-span2">
							<input id="doctor" name="doctor" type="text" style="width: 128px;">
						</span>
					</div>
					<div>
						<span class="west-fieldset-span1"><spring:message code="patient_manager.west.doctor.photomaker"/></span>
						<span class="west-fieldset-span2">
							<input id="photomaker" name="photomaker" type="text" style="width: 128px;">
						</span>
					</div>
				</fieldset>
			</div>
			<div id="center" region="center" style="overflow:hidden;padding:0px;">
			    <div class="easyui-layout" fit="true">
					<div id="northpanel" region="north" class="easyui-panel" title="<spring:message code="patient_manager.north.title"/>" style="width:100%;height:65%;" split="true">
						<table id="study_grid">
						</table>
					</div>
					<div region="center" class="easyui-panel" title="<spring:message code="patient_manager.center.title"/>" style="width:100%;height:35%;">
						<table id="series_grid">
						</table>
					</div>
				</div>
			</div>
			
			</div>

		</div>
	</div>
	
	
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->	
	<jsp:include page="./micia_quick_slidebar.jsp"></jsp:include>
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<jsp:include page="./micia_footer.jsp"></jsp:include>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- myself -->
<script src="${scripts}/patientManager.js" type="text/javascript"></script>
<script src="${scripts}/patientManager2.js" type="text/javascript"></script>
<!-- myself -->
<script>
var userrole = '<%=userDetail.getAuthorities() %>';
var userId = '<%=userDetail.getUserId() %>';
var cloudusername = '<%=userDetail.getPacsUser().getCloudusername() %>';
var cloudpassword = '<%=userDetail.getPacsUser().getCloudpassword() %>';
jQuery(document).ready(function() { 
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   MiciaLayout.init();
   $("#studystarttime, #studyendtime").datebox("setValue", formatDate(new Date()));
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>