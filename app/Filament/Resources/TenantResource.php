<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Models\Tenant;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->label('Id')
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(fn (?string $state): string => strtolower($state))
                    // ->afterStateUpdated(function (string $operation, Set $set, Get $get, ?string $state, ?string $old) {
                    //     if ($operation === 'edit') {
                    //         return;
                    //     }
                    //     $domains = $get('domains');

                    //     $firstDomainKey = array_keys($domains)[0];
                    //     if (data_get($domains, $firstDomainKey.'.domain', 0) !== $old) {
                    //         return;
                    //     }
                    //     data_set($domains, $firstDomainKey.'.domain', $state);

                    //     $set('domains', $domains);

                    // })
                    ->unique(ignoreRecord: true)
                    ->notIn(['admin'])
                    ->required(),
                TextInput::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->required(),
                // Forms\Components\Repeater::make('domains')
                //     ->relationship()
                //     ->simple(
                //         Forms\Components\TextInput::make('domain')
                //             ->label('Domain')
                //             ->dehydrateStateUsing(fn (?string $state): string => strtolower($state))
                //             ->live(onBlur: true)
                //             ->unique(ignoreRecord: true)
                //             ->prefix(get_url_preffix())
                //             ->suffix(get_url_suffix())
                //             ->required(),
                //     )
                //     ->deletable(function (?array $state) {
                //         return count($state) > 1;
                //     })
                //     ->defaultItems(1)
                //     ->reorderable(false)
                //     ->addActionLabel('Add domain'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('url')
                    ->url(fn (Tenant $tenant) => $tenant->url, shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-alt')
                    ->iconColor('primary'),
                // TextColumn::make('domains.domain')
                //     ->listWithLineBreaks()
                //     ->limitList(2)
                //     ->expandableLimitedList()
                //     ->formatStateUsing(function (string $state) {
                //         $url = create_tenant_home_url($state);

                //         return "<a class='text-underline' href='{$url}' target='_blank'>{$url}</a>";
                //     })
                //     ->disabledClick()
                //     ->html()
                //     ->icon('heroicon-o-globe-alt')
                //     ->iconColor('primary'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}
