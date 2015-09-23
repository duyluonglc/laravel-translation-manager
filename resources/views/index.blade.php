@extends((isset($package) ? $package . '::' : '') . 'layouts.master')

@section('content')
    <div class="col-sm-12 translation-manager">
        <div class="row">
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>@lang($package . '::messages.translation-manager')</h1>
                        {{-- csrf_token() --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>@lang($package . '::messages.export-warning-text')</p>

                        <?= ifInPlaceEdit("@lang($package . '::messages.import-all-done')") ?>
                        <div class="alert alert-danger alert-hideable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="errors-alert">
                            </div>
                        </div>
                        <div class="alert alert-success alert-hideable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="success-import-all">
                            <p>@lang($package . '::messages.import-all-done')</p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang($package . '::messages.import-group-done')", ['group' => $group]) ?>
                        <div class="alert alert-success alert-hideable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="success-import-group">
                                <p>@lang($package . '::messages.import-group-done', ['group' => $group]) </p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang($package . '::messages.search-done')") ?>
                        <div class="alert alert-success alert-hideable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="success-find">
                                <p>@lang($package . '::messages.search-done')</p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang($package . '::messages.done-publishing')", ['group' => $group]) ?>
                        <div class="alert alert-success alert-hideable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="success-publish">
                                <p>@lang($package . '::messages.done-publishing', ['group'=> $group])</p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang($package . '::messages.done-publishing-all')") ?>
                        <div class="alert alert-success alert-hideable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="success-publish-all">
                                <p>@lang($package . '::messages.done-publishing-all')</p>
                            </div>
                        </div>

                        <?php if(Session::has('successPublish')) : ?>
                        <div class="alert alert-info alert-hideable">
                            <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Session::get('successPublish'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($adminEnabled)
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="form-import-all" class="form-import-all" method="POST"
                                            action="<?= action($controller . '@postImport', ['group' => '*']) ?>"
                                            data-remote="true" role="form">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= ifEditTrans($package . '::messages.import-add') ?>
                                                <?= ifEditTrans($package . '::messages.import-replace') ?>
                                                <?= ifEditTrans($package . '::messages.import-fresh') ?>
                                                <div class="input-group-sm">
                                                    <select name="replace" class="import-select form-control">
                                                        <option value="0"><?= noEditTrans($package . '::messages.import-add') ?></option>
                                                        <option value="1"><?= noEditTrans($package . '::messages.import-replace') ?></option>
                                                        <option value="2"><?= noEditTrans($package . '::messages.import-fresh') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= ifEditTrans($package . '::messages.import-groups') ?>
                                                <?= ifEditTrans($package . '::messages.loading') ?>
                                                <button id="submit-import-all" type="submit" form="form-import-all"
                                                        class="btn btn-sm btn-success"
                                                        data-disable-with="<?= noEditTrans($package . '::messages.loading') ?>">
                                                    <?= noEditTrans($package . '::messages.import-groups') ?>
                                                </button>
                                                <?= ifEditTrans($package . '::messages.zip-all') ?>
                                                <a href="<?= action($controller . '@getZippedTranslations', ['group' => '*']) ?>"
                                                        role="button" class="btn btn-primary btn-sm">
                                                    <?= noEditTrans($package . '::messages.zip-all') ?>
                                                </a>
                                                <div class="input-group" style="float:right; display:inline">
                                                    <?= ifEditTrans($package . '::messages.publish-all') ?>
                                                    <?= ifEditTrans($package . '::messages.publishing') ?>
                                                    <button type="submit" form="form-publish-all"
                                                            class="btn btn-sm btn-warning input-control"
                                                            data-disable-with="<?= noEditTrans($package . '::messages.publishing') ?>">
                                                        <?= noEditTrans($package . '::messages.publish-all') ?>
                                                    </button><?= ifEditTrans($package . '::messages.publish-all') ?>
                                                    <?= ifEditTrans($package . '::messages.find-in-files') ?>
                                                    <?= ifEditTrans($package . '::messages.searching') ?>
                                                    <button type="submit" form="form-find"
                                                            class="btn btn-sm btn-danger"
                                                            data-disable-with="<?= noEditTrans($package . '::messages.searching') ?>">
                                                        <?= noEditTrans($package . '::messages.find-in-files') ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?= ifEditTrans($package . '::messages.confirm-find') ?>
                                    <form id="form-find" class="form-inline form-find" method="POST"
                                            action="<?= action($controller . '@postFind') ?>"
                                            data-remote="true" role="form"
                                            data-confirm="<?= noEditTrans($package . '::messages.confirm-find') ?>">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div style="min-height: 10px"></div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= ifEditTrans($package . '::messages.choose-group'); ?>
                                        <div class="input-group-sm">
                                            <?= Form::select('group', $groups, $group, array( 'form' => 'form-select',
                                                    'class' => 'group-select form-control'
                                            )) ?>
                                        </div>
                                    </div>
                                    <?php if ($adminEnabled): ?>
                                    <div class="col-sm-6">
                                        <?php if ($group): ?>
                                        <?= ifEditTrans($package . '::messages.publishing') ?>
                                        <?= ifEditTrans($package . '::messages.publish') ?>
                                        <button type="submit" form="form-publish-group"
                                                class="btn btn-sm btn-info input-control"
                                                data-disable-with="<?= noEditTrans($package . '::messages.publishing') ?>">
                                            <?= noEditTrans($package . '::messages.publish') ?>
                                        </button>
                                        <?= ifEditTrans($package . '::messages.zip-group') ?>
                                        <a href="<?= action($controller . '@getZippedTranslations', ['group' => $group]) ?>"
                                                role="button" class="btn btn-primary btn-sm">
                                            <?= noEditTrans($package . '::messages.zip-group') ?>
                                        </a>
                                        <?php endif; ?>
                                        <div class="input-group" style="float:right; display:inline">
                                            <?php if ($group): ?>
                                            <?= ifEditTrans($package . '::messages.import-group') ?>
                                            <?= ifEditTrans($package . '::messages.loading') ?>
                                            <button type="submit" form="form-import" class="btn btn-sm btn-success"
                                                    data-disable-with="<?= noEditTrans($package . '::messages.loading') ?>">
                                                <?= noEditTrans($package . '::messages.import-group') ?>
                                            </button>
                                            <?= ifEditTrans($package . '::messages.delete') ?>
                                            <?= ifEditTrans($package . '::messages.deleting') ?>
                                            <button type="submit" form="form-delete-group" class="btn btn-sm btn-danger"
                                                    data-disable-with="<?= noEditTrans($package . '::messages.deleting') ?>">
                                                <?= noEditTrans($package . '::messages.delete') ?>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?= ifEditTrans($package . '::messages.confirm-delete') ?>
                                    <form id="form-delete-group" class="form-inline form-delete-group" method="POST"
                                            action="<?= action($controller . '@postDeleteAll', $group) ?>"
                                            data-remote="true" role="form"
                                            data-confirm="<?= noEditTrans($package . '::messages.confirm-delete', ['group' => $group]) ?>">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"></form>
                                    <form id="form-import" class="form-inline form-import" method="POST"
                                            action="<?= action($controller . '@postImport', $group) ?>"
                                            data-remote="true" role="form"><input type="hidden" name="_token"
                                                value="<?php echo csrf_token(); ?>"></form>
                                    <form role="form" class="form" id="form-select"></form>
                                    <form id="form-publish-group" class="form-inline form-publish-group" method="POST"
                                            action="<?= action($controller . '@postPublish', $group) ?>"
                                            data-remote="true" role="form"><input type="hidden" name="_token"
                                                value="<?php echo csrf_token(); ?>"></form>
                                    <form id="form-publish-all" class="form-inline form-publish-all" method="POST"
                                            action="<?= action($controller . '@postPublish', '*') ?>"
                                            data-remote="true" role="form"><input type="hidden" name="_token"
                                                value="<?php echo csrf_token(); ?>"></form>
                                </div>
                            </div>
                        </div>
                        <div style="min-height: 10px"></div>

                        <div class="row">
                            <?php if(!$group): ?>
                            <div class="col-sm-10">
                                <p>@lang($package . '::messages.choose-group-text')</p>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#searchModal" style="float:right; display:inline">
                                    <?= noEditTrans($package . '::messages.search') ?>
                                </button>
                                <?= ifEditTrans($package . '::messages.search') ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div style="min-height: 10px"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="min-height: 10px"></div>

                        <form class="form-inline" id="form-interface-locale" class="form-interface-locale" method="GET"
                                action="<?= action($controller . '@getInterfaceLocale') ?>">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="row">
                                <div class=" col-sm-3">
                                    <div class="input-group-sm">
                                        <label for="interface-locale"><?= trans($package . '::messages.interface-locale') ?>:</label>
                                        <select name="l" id="interface-locale" class="form-control" ?>">
                                            @foreach($locales as $locale)
                                                <option value="<?=$locale?>"<?= $currentLocale === $locale ? ' selected="selected"' : ''?>><?= $locale ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-3">
                                    <div class="input-group-sm">
                                        <label for="translating-locale"><?= trans($package . '::messages.translating-locale') ?>:</label>
                                        <select name="t" id="translating-locale" class="form-control" ?>">
                                            @foreach($locales as $locale)
                                                @if($locale !== $primaryLocale) continue;
                                                <option value="<?=$locale?>"<?= $translatingLocale === $locale ? ' selected="selected"' : ''?>><?= $locale ?></option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-3">
                                    <div class="input-group-sm">
                                        <label for="primary-locale"><?= trans($package . '::messages.primary-locale') ?>:</label>
                                        <select name="p" id="primary-locale" class="form-control" ?>">
                                            @foreach($locales as $locale)
                                            <option value="<?=$locale?>"<?= $primaryLocale === $locale ? ' selected="selected"' : ''?>><?= $locale ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-3">
                                    <div class="input-group" style="float:right; display:inline">
                                        <?= ifEditTrans($package . '::messages.in-place-edit') ?>
                                        <a class="btn btn-sm btn-primary" role="button" href="<?= action($controller . '@getToggleInPlaceEdit') ?>">
                                            <?= noEditTrans($package . '::messages.in-place-edit') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="min-height: 10px"></div>

                            <div class="row">
                                <div class=" col-sm-3">
                                    <div class="row">
                                        <div class=" col-sm-12">
                                            <?= formSubmit(trans($package . '::messages.display-locales')
                                                    , ['class' => "btn btn-sm btn-primary"]) ?>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-12">
                                            <div style="min-height: 10px"></div>
                                            <?= ifEditTrans($package . '::messages.check-all') ?>
                                            <button id="display-locale-all"
                                                    class="btn btn-sm btn-default"><?= noEditTrans($package . '::messages.check-all')?></button>
                                            <?= ifEditTrans($package . '::messages.check-none') ?>
                                            <button id="display-locale-none"
                                                    class="btn btn-sm btn-default"><?= noEditTrans($package . '::messages.check-none')?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-sm-9">
                                    <div class="input-group-sm">
                                        @foreach($locales as $locale)
                                            <label>
                                                <input <?= $locale !== $primaryLocale && $locale !== $translatingLocale ? ' class="display-locale" ' : '' ?> name="d[]"
                                                        type="checkbox"
                                                        value="<?=$locale?>"
                                                <?= ($locale === $primaryLocale || $locale === $translatingLocale || array_key_exists($locale, $displayLocales)) ? 'checked' : '' ?>
                                                <?= $locale === $primaryLocale ? ' disabled' : '' ?>><?= $locale ?>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        @include($package . '::dashboard')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($mismatchEnabled && !empty($mismatches))
                            @include($package . '::mismatched')
                        @endif
                    </div>
                </div>
            </div>
        </div><?= ifEditTrans($package . '::messages.enter-translation') ?>
        <?= ifEditTrans($package . '::messages.missmatched-quotes') ?>
        <script>
            var MISSMATCHED_QUOTES_MESSAGE = "<?= noEditTrans(($package . '::messages.missmatched-quotes'))?>";
        </script>
        <?php if($group): ?>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <?= ifEditTrans($package . '::messages.suffixed-keyops') ?>
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                        aria-expanded="false" aria-controls="collapseOne">
                                    <?= noEditTrans($package . '::messages.suffixed-keyops') ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingOne">
                            <div class="panel-body">
                                <!-- Add Keys Form -->
                                <div class="col-sm-12">
                                    <?=  Form::open(['id' => 'form-addkeys', 'method' => 'POST', 'action' => [$controller . '@postAdd', $group]]) ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="keys">@lang($package . '::messages.keys'):</label><?= ifEditTrans($package . '::messages.addkeys-placeholder') ?>
                                                <?=  Form::textarea('keys', Input::old('keys'), ['class'=>"form-control", 'rows'=>"4", 'style'=>"resize: vertical",
                                                        'placeholder'=>noEditTrans($package . '::messages.addkeys-placeholder')]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="suffixes">@lang($package . '::messages.suffixes'):</label><?= ifEditTrans($package . '::messages.addsuffixes-placeholder') ?>
                                                <?=  Form::textarea('suffixes', Input::old('suffixes'), ['class'=>"form-control", 'rows'=>"4", 'style'=>"resize: vertical",
                                                        'placeholder'=> noEditTrans($package . '::messages.addsuffixes-placeholder')]) ?>
                                            </div>
                                        </div>
                                        <div style="min-height: 10px"></div>
                                        <script>
                                            var currentGroup = '{{$group}}';
                                            function addStandardSuffixes(event) {
                                                event.preventDefault();
                                                $("#form-addkeys").first().find("textarea[name='suffixes']")[0].value = "-type\n-header\n-heading\n-description\n-footer" + (currentGroup === 'systemmessage-texts' ? '\n-footing' : '');
                                            }
                                            function clearSuffixes(event) {
                                                event.preventDefault();
                                                $("#form-addkeys").first().find("textarea[name='suffixes']")[0].value = "";
                                            }
                                            function clearKeys(event) {
                                                event.preventDefault();
                                                $("#form-addkeys").first().find("textarea[name='keys']")[0].value = "";
                                            }
                                            function postDeleteSuffixedKeys(event) {
                                                event.preventDefault();
                                                var elem = $("#form-addkeys").first();
                                                elem[0].action = "<?= action($controller . '@postDeleteSuffixedKeys', $group)?>";
                                                elem[0].submit();
                                            }
                                        </script>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= formSubmit(trans($package . '::messages.addkeys'), ['class' => "btn btn-sm btn-primary"]) ?>
                                                <?= ifEditTrans($package . '::messages.clearkeys') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="clearKeys(event)"><?= noEditTrans($package . '::messages.clearkeys') ?>
                                                </button>
                                                <div class="input-group" style="float:right; display:inline">
                                                    <?= ifEditTrans($package . '::messages.deletekeys') ?>
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="postDeleteSuffixedKeys(event)">
                                                        <?= noEditTrans($package . '::messages.deletekeys') ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= ifEditTrans($package . '::messages.addsuffixes') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="addStandardSuffixes(event)"><?= noEditTrans($package . '::messages.addsuffixes') ?></button>
                                                <?= ifEditTrans($package . '::messages.clearsuffixes') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="clearSuffixes(event)"><?= noEditTrans($package . '::messages.clearsuffixes') ?></button>
                                            </div>
                                            <div class="col-sm-2">
                                                <span style="float:right; display:inline">
                                                    <?= ifEditTrans($package . '::messages.search'); ?>
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#searchModal"><?= noEditTrans($package . '::messages.search') ?></button>
                                                </span>
                                            </div>
                                        </div>
                                    <?=  Form::close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <?= ifEditTrans($package . '::messages.wildcard-keyops') ?>
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                    <?= noEditTrans($package . '::messages.wildcard-keyops') ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <!-- Key Ops Form -->
                                <div id="wildcard-keyops-results" class="results"></div>
                                <?=  Form::open(['id' => 'form-keyops', 'data-remote'=>"true", 'method' => 'POST',
                                        'action' => [$controller . '@postPreviewKeys', $group]]) ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="srckeys">@lang($package . '::messages.srckeys'):</label><?= ifEditTrans($package . '::messages.srckeys-placeholder') ?>
                                            <?=  Form::textarea('srckeys', Input::old('srckeys'), ['id' => 'srckeys', 'class'=>"form-control", 'rows'=>"4", 'style'=>"resize: vertical",
                                                    'placeholder'=>noEditTrans($package . '::messages.srckeys-placeholder')]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="dstkeys">@lang($package . '::messages.dstkeys'):</label><?= ifEditTrans($package . '::messages.dstkeys-placeholder') ?>
                                            <?=  Form::textarea('dstkeys', Input::old('dstkeys'), ['id' => 'dstkeys', 'class'=>"form-control", 'rows'=>"4", 'style'=>"resize: vertical",
                                                    'placeholder'=> noEditTrans($package . '::messages.dstkeys-placeholder')]) ?>
                                        </div>
                                    </div>
                                    <div style="min-height: 10px"></div>
                                    <script>
                                        var currentGroup = '{{$group}}';
                                        function clearDstKeys(event) {
                                            event.preventDefault();
                                            $("#form-keyops").first().find("textarea[name='dstkeys']")[0].value = "";
                                        }
                                        function clearSrcKeys(event) {
                                            event.preventDefault();
                                            $("#form-keyops").first().find("textarea[name='srckeys']")[0].value = "";
                                        }
                                        function postPreviewKeys(event) {
                                            //event.preventDefault();
                                            var elem = $("#form-keyops").first();
                                            elem[0].action = "<?= action($controller . '@postPreviewKeys', $group)?>";
                                            //elem[0].submit();
                                        }
                                        function postMoveKeys(event) {
                                            //event.preventDefault();
                                            var elem = $("#form-keyops").first();
                                            elem[0].action = "<?= action($controller . '@postMoveKeys', $group)?>";
                                            //elem[0].submit();
                                        }
                                        function postCopyKeys(event) {
                                            //event.preventDefault();
                                            var elem = $("#form-keyops").first();
                                            elem[0].action = "<?= action($controller . '@postCopyKeys', $group)?>";
                                            //elem[0].submit();
                                        }
                                        function postDeleteKeys(event) {
                                            //event.preventDefault();
                                            var elem = $("#form-keyops").first();
                                            elem[0].action = "<?= action($controller . '@postDeleteKeys', $group)?>";
                                            //elem[0].submit();
                                        }
                                    </script>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?= ifEditTrans($package . '::messages.clearsrckeys') ?>
                                            <button class="btn btn-sm btn-primary"
                                                    onclick="clearSrcKeys(event)"><?= noEditTrans($package . '::messages.clearsrckeys') ?></button>
                                            <div class="input-group" style="float:right; display:inline">
                                                <?= formSubmit(trans($package . '::messages.preview'), [
                                                        'class' => "btn btn-sm btn-primary",
                                                        'onclick' => 'postPreviewKeys(event)'
                                                ]) ?>
                                                <?= ifEditTrans($package . '::messages.copykeys'); ?>
                                                <button class="btn btn-sm btn-primary" onclick="postCopyKeys(event)">
                                                    <?= noEditTrans($package . '::messages.copykeys') ?>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= ifEditTrans($package . '::messages.cleardstkeys') ?>
                                            <button class="btn btn-sm btn-primary"
                                                    onclick="clearDstKeys(event)"><?= noEditTrans($package . '::messages.cleardstkeys') ?></button>
                                            <div class="input-group" style="float:right; display:inline">
                                                <?= ifEditTrans($package . '::messages.movekeys') ?>
                                                <button class="btn btn-sm btn-warning" onclick="postMoveKeys(event)">
                                                    <?= noEditTrans($package . '::messages.movekeys') ?>
                                                </button><?= ifEditTrans($package . '::messages.deletekeys') ?>
                                                <button class="btn btn-sm btn-danger" onclick="postDeleteKeys(event)">
                                                    <?= noEditTrans($package . '::messages.deletekeys') ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?=  Form::close() ?>
                            </div>
                        </div>
                    </div>
                    </div>@if($yandex_key)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <?= ifEditTrans($package . '::messages.translation-ops') ?>
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <?= noEditTrans($package . '::messages.translation-ops') ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <textarea id="primary-text" class="form-control" rows="3" name="keys"
                                                    style="resize: vertical;" placeholder="<?= $primaryLocale ?>"></textarea>
                                            <div style="min-height: 10px"></div>
                                            <span style="float:right; display:inline">
                                                <button id="translate-primary-current" type="button" class="btn btn-sm btn-primary">
                                                    <?= $primaryLocale ?>&nbsp;<i class="glyphicon glyphicon-share-alt"></i>&nbsp;<?= $translatingLocale ?>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="col-sm-6">
                                            <textarea id="current-text" class="form-control" rows="3" name="keys"
                                                style="resize: vertical;" placeholder="<?= $translatingLocale ?>"></textarea>
                                            <div style="min-height: 10px"></div>
                                            <button id="translate-current-primary" type="button" class="btn btn-sm btn-primary">
                                                <?= $translatingLocale ?>&nbsp;<i class="glyphicon glyphicon-share-alt"></i>&nbsp;<?= $primaryLocale ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 ">
                <div style="min-height: 10px"></div>
                <table class="table table-condensed table-striped table-translations">
                    <thead>
                        <tr>
                            <?php if($adminEnabled): ?>
                            <th width="1%">&nbsp;</th>
                            <?php endif; ?>
                            <th width="20%">@lang($package . '::messages.key')</th>
                            <?php
                                $setWidth = count($displayLocales);
                                if ($setWidth > 3) {
                                    $mainWidth = 30;
                                }
                                else
                                {
                                    $mainWidth = 40;
                                }
                                $col = 0;
                            ?>
                            <?php foreach($locales as $locale): ?>
                            <?php if (!array_key_exists($locale, $displayLocales)) continue; ?>
                            <?php if ($col < 2): ?>
                                <?php if ($col === 0): ?>
                            <th width="<?=$mainWidth?>%"><?= $locale ?>&nbsp;
                                <?= ifEditTrans($package . '::messages.auto-fill-disabled') ?>
                                <?= ifEditTrans($package . '::messages.auto-fill') ?>
                                <a class="btn btn-sm btn-primary" id="auto-fill" role="button"
                                        data-disable-with="<?=noEditTrans($package . '::messages.auto-fill-disabled')?>"
                                        href="#') ?>"><?= noEditTrans($package . '::messages.auto-fill') ?></a>
                            </th>
                                <?php elseif ($col === 1 && isset($yandex_key) && $yandex_key): ?>
                            <th width="<?=$mainWidth?>%"><?= $locale ?>&nbsp;
                                <?= ifEditTrans($package . '::messages.auto-translate-disabled') ?>
                                <?= ifEditTrans($package . '::messages.auto-translate') ?>
                                <a class="btn btn-sm btn-primary" id="auto-translate" role="button"
                                        data-disable-with="<?=noEditTrans($package . '::messages.auto-translate-disabled')?>"
                                        href="#') ?>"><?= noEditTrans($package . '::messages.auto-translate') ?></a>
                            </th>
                                <?php else: ?>
                            <th width="<?=$mainWidth?>%"><?= $locale ?></th><?php endif;?>
                            <?php else: ?>
                            <th><?= $locale ?></th>
                                <?php endif;
                                $col++; ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $translator = App::make('translator');
                        foreach($translations as $key => $translation)
                        {
                            $is_deleted = 0;
                            foreach($locales as $locale)
                            {
                                if (!array_key_exists($locale, $displayLocales)) continue;
                                if (isset($translation[$locale]) && $translation[$locale]->is_deleted) $is_deleted = 1;
                            }
                        ?>
                        <tr id="<?= str_replace('.', '-', $key) ?>" <?= $is_deleted ? ' class="deleted-translation"' : '' ?>>
                            <?php if($adminEnabled): ?>
                            <td>
                                <a href="<?= action($controller . '@postUndelete', [$group, $key]) ?>"
                                        class="undelete-key <?= $is_deleted ? "" : "hidden" ?>" data-method="POST"
                                        data-remote="true">
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                </a>
                                <a href="<?= action($controller . '@postDelete', [$group, $key]) ?>"
                                        class="delete-key <?= !$is_deleted ? "" : "hidden" ?>" data-method="POST"
                                        data-remote="true">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                            <?php endif; ?>
                            <td><?= $key ?></td>
                            <?php foreach($locales as $locale): ?>
                            <?php if (!array_key_exists($locale, $displayLocales)) continue; ?>
                            <?php $t = isset($translation[$locale]) ? $translation[$locale] : null ?>
                            <td <?= $locale === $translatingLocale ? 'class="auto-translatable"' : ($locale === $primaryLocale ? 'class="auto-fillable"' : '') ?>>
                                <?= $translator->inPlaceEditLink(!$t ? $t : ($t->value == '' ? null : $t), true, "$group.$key", $locale, null, $group) ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"
                                id="myModalLabel">@lang($package . '::messages.search-translations')</h4>
                    </div>
                    <div class="modal-body">
                        <form id="search-form" method="GET" action="<?= action($controller . '@getSearch') ?>" data-remote="true">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="search-form-text" type="search" name="q" class="form-control">
                                    <span class="input-group-btn">
                                        <?= formSubmit(trans($package . '::messages.search'), ['class' => "btn btn-default"]) ?>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="results"></div>
                    </div>
                    <div class="modal-footer">
                        <?= ifEditTrans($package . '::messages.close') ?>
                        <button type="button" class="btn btn-sm btn-default"
                                data-dismiss="modal"><?= noEditTrans($package . '::messages.close') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- KeyOp Modal -->
        <div class="modal fade" id="keyOpModal" tabindex="-1" role="dialog" aria-labelledby="keyOpModalLabel"
                aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                                id="keyOpModalLabel">@lang($package . '::messages.keyop-header')</h4>
                    </div>
                    <div class="modal-body">
                        <div class="results"></div>
                    </div>
                    <div class="modal-footer">
                        <?= ifEditTrans($package . '::messages.close') ?>
                        <button type="button" class="btn btn-sm btn-default"
                                data-dismiss="modal"><?= noEditTrans($package . '::messages.close') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('body-bottom')
    <script>
        var URL_YANDEX_TRANSLATOR_KEY = '<?= action($controller . '@postYandexKey') ?>';
        var PRIMARY_LOCALE = '{{$primaryLocale}}';
        var CURRENT_LOCALE = '{{$currentLocale}}';
        var TRANSLATING_LOCALE = '{{$translatingLocale}}';
        var URL_TRANSLATOR_GROUP = '<?= action($controller . '@getView') ?>/';
        var URL_TRANSLATOR_ALL = '<?= action($controller . '@getIndex') ?>';
    </script>

    <!-- Moved out to allow auto-format in PhpStorm w/o screwing up HTML format -->
    <script src="<?=  $public_prefix . $package ?>/js/translations_page.js"></script>
@stop
