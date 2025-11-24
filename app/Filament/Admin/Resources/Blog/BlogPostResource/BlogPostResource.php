<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Blog\BlogPostResource;

use App\Filament\Admin\Resources\Blog\BlogPostResource\Pages\CreateBlogPost;
use App\Filament\Admin\Resources\Blog\BlogPostResource\Pages\EditBlogPost;
use App\Filament\Admin\Resources\Blog\BlogPostResource\Pages\ListBlogPosts;
use App\Filament\Admin\Resources\Blog\BlogPostResource\Schemas\BlogPostForm;
use App\Filament\Admin\Resources\Blog\BlogPostResource\Schemas\BlogPostsTable;
use App\Models\Blog\BlogPost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

final class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $label = 'Posts';

    protected static ?string $pluralLabel = 'Posts do Blog';

    protected static string|UnitEnum|null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 2;

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'excerpt', 'content'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Título' => $record->title,
            'Status' => match ($record->status) {
                'draft' => 'Rascunho',
                'published' => 'Publicado',
                'scheduled' => 'Agendado',
            },
            'Categoria' => $record->category?->name ?? 'Sem categoria',
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return BlogPostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogPostsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogPosts::route('/'),
            'create' => CreateBlogPost::route('/create'),
            'edit' => EditBlogPost::route('/{record}/edit'),
        ];
    }
}
