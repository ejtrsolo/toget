<?php
/**
 * Created by ejtrsolo.
 * User: Ernesto
 * Date: 25/08/2016
 * Time: 08:21 PM
 */
use yii\web\View;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB0mfIhuVDFxiJyixvCCNjKby29ekKhFJQ', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/route-min.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->title="Agregar nueva ruta";
$this->blocks['content-header']='';
?>

<div class="site-contact">
    <div class="panel panel-info">
        <div class="panel-heading">
            Agregar nueva ruta
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-9">
                    <label for="txt-map">Ingresar ruta</label>
                    <div id="map" style="width:100%; height:400px;"></div>
                    <div style="height: 10px;" class="hidden-md">
                        <hr>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="txt-route">Controles de mapa</label>
                    <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <div class="form-group">
                                <button id="btn-play" style="width: 38px;" class="btn btn-info" title="Iniciar captura de ruta">
                                    <i class="fa fa-play"></i>
                                </button>
                                <input type="hidden" id="in-play" value="0">
                                <label id="lb-play" class="label-normal" for="btn-play"> Iniciar captura</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <div class="form-group">
                                <button id="btn-remove-last" style="width: 38px;" class="btn btn-warning" title="Borrar último punto">
                                    <i class="fa fa-step-backward"></i>
                                </button>
                                <label class="label-normal" for="btn-play"> Borrar último</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <div class="form-group">
                                <button id="btn-remove-all" style="width: 38px;" class="btn btn-danger" title="Borrar todos los puntos del mapa">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <label class="label-normal" for="btn-play"> Borrar todos</label>
                            </div>
                        </div>
                    </div>
                    <div style="height: 10px;"></div>
                    <div class="form-group">
                        <label for="txt-route">Puntos de ruta</label>
                        <textarea id="txt-route" rows="7" class="form-control" style="font-size: smaller;" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <?=Html::submitButton('Guardar ruta', ['class'=>'btn btn-primary btn-flat pull-right'])?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
