<?php

namespace App\Filament\Resources;

use App\Exports\TeacherExport;
use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Teacher Data')->schema([
                    TextInput::make('full_name')->required()->maxLength(100),
                    TextInput::make('university')->required()->maxLength(100),
                    TextInput::make('country')->required()->maxLength(50),
                    TextInput::make('city')->required()->maxLength(50),
                    TextInput::make('Field')->required()->maxLength(100),
                    Forms\Components\Fieldset::make('Contacts')->schema([
                            TextInput::make('url')->url()->suffixIcon('heroicon-m-globe-alt'),
                            TextInput::make('email')->maxLength(100)->email()->suffixIcon('heroicon-o-envelope'),
                    ])
                ]),
                Forms\Components\Fieldset::make('Email Data')->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Toggle::make('sent')
                            ->onIcon('heroicon-o-paper-airplane')
                            ->offIcon('heroicon-s-paper-airplane')
                            ->onColor('success')
                            ->offColor('gray'),
                    ]),
                    DatePicker::make('start_date'),
                    Forms\Components\Fieldset::make('Reminders')->schema([
                        DatePicker::make('first_reminder'),
                        DatePicker::make('second_reminder'),
                        DatePicker::make('third_reminder'),
                    ]),
                    Forms\Components\Fieldset::make('Status')->schema([
                        Forms\Components\Textarea::make('situation'),
                        Forms\Components\Textarea::make('final'),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('full_name')->limit(50)
                    ->url(fn (Teacher $record): string => 'https://www.google.com/search?q='. $record->full_name)
                    ->openUrlInNewTab()
                    ->searchable()
                    ->toggleable(false),
                TextColumn::make('university')->limit(50)
                    ->searchable()
                    ->toggleable(false),
                TextColumn::make('country')->limit(50)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('city')->limit(50)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('field')->limit(50)
                    ->searchable()
                    ->toggleable(false),
                TextColumn::make('url')->limit(50)
                    ->url(fn (Teacher $record): string => ($record->url ?? ''))
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-globe-alt')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email')->limit(50)
                    ->url(fn (Teacher $record): string => ('mailto:' . $record->email ?? ''))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-envelope')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\ToggleColumn::make('sent')
                    ->onColor('success')
                    ->offColor('gray')
                    ->toggleable(),
                TextColumn::make('start_date')->dateTime('Y-m-d')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('first_reminder')->dateTime('Y-m-d')
                    ->toggleable(),
                TextColumn::make('second_reminder')->dateTime('Y-m-d')
                    ->toggleable(),
                TextColumn::make('third_reminder')->dateTime('Y-m-d')
                    ->toggleable(),
                TextColumn::make('situation')->limit(20)
                    ->toggleable(),
                TextColumn::make('final')->limit(20)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('sent')
                    ->placeholder('Nothing')
                    ->trueLabel('Sent')
                    ->falseLabel('Unsent')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('country')
                    ->label('Country')
                    ->options(function () {
                        $collection = Teacher::query()->pluck('country')->unique()->values();
                        return $collection->combine($collection);
                    })
                    ->attribute('country')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('university')
                    ->label('University')
                    ->options(function () {
                        $collection = Teacher::query()->pluck('university')->unique()->values();
                        return $collection->combine($collection);
                    })
                    ->attribute('university')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('field')
                    ->label('Field')
                    ->options(function () {
                        $collection = Teacher::query()->pluck('field')->unique()->values();
                        return $collection->combine($collection);
                    })
                    ->attribute('field')
                    ->searchable(),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                ViewAction::make()
                ->button(),
            ],position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Download Xlsx')
                    ->iconPosition(IconPosition::After)
                    ->icon('heroicon-s-document-arrow-down')
                    ->action(fn () => (new TeacherExport)->download('Teachers.xlsx'))
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }

}
