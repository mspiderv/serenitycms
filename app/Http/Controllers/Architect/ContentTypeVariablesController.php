<?php

namespace Serenity\Http\Controllers\Architect;

use GUI;
use Request;
use Fields;
use Serenity\ContentType;
use Serenity\ContentTypeVariable;
use Illuminate\Database\Eloquent\Model;
use Serenity\CRUD\Traits\CRUDControllerTrait;
use Vitlabs\GUIAdmin\Contracts\Elements\TableContract;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class ContentTypeVariablesController extends Controller
{
    use CRUDControllerTrait;

    protected $basicRoute = 'admin.architect.content-type-variables';
    protected $model = ContentTypeVariable::class;

    protected function fillIndexTable(TableContract $table)
    {
        // Generate main rows
        foreach (ContentType::all() as $contentType)
        {
            $table->addRow([
                a($contentType->name, 'admin.architect.content-types.edit', $contentType->id),

                a_table('Upraviť', 'admin.architect.content-types.edit', $contentType->id) .
                a_table('Zmazať', 'admin.architect.content-types.destroy', $contentType->id) .
                a_table('Pridať premennú', route('admin.architect.content-type-variables.create') . '?content_type_id=' . $contentType->id),
            ])
            ->id($contentType->id)
            ->sortgroup('content_types')
            ->model(ContentType::class);

            // Generate sub rows
            foreach ($contentType->variables as $variable)
            {
                $table->addRow([
                    a($variable->variable, 'admin.architect.content-type-variables.edit', $variable->id),

                    a_table('Upraviť', 'admin.architect.content-type-variables.edit', $variable->id) .
                    a_table('Odstrániť', 'admin.architect.content-type-variables.destroy', $variable->id),
                ])
                ->level(1)
                ->id($variable->id)
                ->sortgroup($contentType->id)
                ->model(ContentTypeVariable::class);
            }
        }
    }

    protected function generateUniversalForm(FormContract $form, Model $model = null)
    {
        GUI::input()
            ->label("Variable name")
            ->name('variable')
            ->value(val('variable', $model))
            ->to($form);

        GUI::select()
            ->label("Content type")
            ->name('content_type_id')
            ->options(ContentType::pluck('name', 'id')->all())
            ->value(val('content_type_id', $model))
            ->to($form);

		GUI::select()
            ->label("Field")
            ->name('field')
            ->options(Fields::getHumanNames())
            ->value(val('field', $model))
            ->to($form);

		GUI::select()
            ->label("Data type")
            ->name('data_type')
            ->options(get_named_data_types())
            ->value(val('data_type', $model))
            ->to($form);

        GUI::input()
            ->label("Constraint")
            ->name('constraint')
            ->value(val('constraint', $model))
            ->to($form);

        GUI::checkbox()
            ->label("Nullable")
            ->name('nullable')
            ->value(val('nullable', $model, true))
            ->to($form);

        GUI::checkbox()
            ->label("Unsigned")
            ->name('unsigned')
            ->value(val('unsigned', $model))
            ->to($form);
    }

}
