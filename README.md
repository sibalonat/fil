## Steps to Create and Manage the PluginsResource

### 1. Create the Plugin Model and Migration
Run the following command to create the Plugin model and its migration:
`php artisan make:model Plugin -m`

### Run the migration to create the table:
`php artisan migrate`
### Run the seeder to test:
`php artisan db:seed`
### Check the functionality inside the PluginResource
```php
public static function table(Table $table): Table
{
    return $table
        ->query(Plugin::query())
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->formatStateUsing(fn ($state) => ucfirst($state)), // Capitalize the first character
            Tables\Columns\TextColumn::make('version'),
            Tables\Columns\ToggleColumn::make('active') // Use ToggleColumn for status
                ->label('Status')
                ->onColor('success')
                ->offColor('danger'),
        ])
        ->filters([
            // Add filters if needed
        ])
        ->actions([
            Tables\Actions\EditAction::make(), // Allow editing
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(), // Allow bulk deletion
        ]);
}
```
### Access the Plugin Status
`php artisan serve`
