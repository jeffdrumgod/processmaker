<?php

/**
 * departments.php
 *
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.23
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * For more information, contact Colosa Inc, 2566 Le Jeune Rd.,
 * Coral Gables, FL, 33134, USA, or email info@colosa.com.
 */
$c = new Configurations();

$access = $RBAC->requirePermissions( 'PM_USERS' );
if ($access != 1) {
    switch ($access) {
        case - 1:
            G::SendTemporalMessage( 'ID_USER_HAVENT_RIGHTS_PAGE', 'error', 'labels' );
            G::header( 'location: ../login/login' );
            die();
            break;
        case - 2:
            G::SendTemporalMessage( 'ID_USER_HAVENT_RIGHTS_SYSTEM', 'error', 'labels' );
            G::header( 'location: ../login/login' );
            die();
            break;
        default:
            G::SendTemporalMessage( 'ID_USER_HAVENT_RIGHTS_PAGE', 'error', 'labels' );
            G::header( 'location: ../login/login' );
            die();
            break;
    }
}
if (($RBAC_Response = $RBAC->userCanAccess( "PM_USERS" )) != 1) {
    return $RBAC_Response;
}

$G_MAIN_MENU = 'processmaker';
$G_SUB_MENU = 'users';
$G_ID_MENU_SELECTED = 'USERS';
$G_ID_SUB_MENU_SELECTED = 'DEPARTMENTS';

$G_PUBLISH = new Publisher();

$oHeadPublisher = & headPublisher::getSingleton();

$oHeadPublisher->addExtJsScript( 'departments/departmentList', false ); //adding a javascript file .js
$oHeadPublisher->addContent( 'departments/departmentList' ); //adding a html file  .html.


//$labels = G::getTranslations(Array('ID_DEPARTMENTS','ID_DELETE','ID_EDIT','ID_USERS','ID_ACTIVE','ID_INACTIVE','ID_SELECT_STATUS',
//    'ID_CLOSE','ID_SAVE','ID_DEPARTMENT_NAME','ID_STATUS'));
//
//$oHeadPublisher->assign('TRANSLATIONS', $labels);
$oHeadPublisher->assign( 'FORMATS', $c->getFormats() );
G::RenderPage( 'publish', 'extJs' );

