<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\RequiredDocument;
use Illuminate\Database\Seeder;

class RequiredDocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $document_types = DocumentType::all();
        $required_documents = [];
        foreach ($document_types as $document_type) {
            $required_documents[] = [
                'doc_type_id' => $document_type->id,
            ];
        }
        RequiredDocument::insert($required_documents);
    }
}
