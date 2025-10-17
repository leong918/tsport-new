<?php

namespace App\Repositories;

use App\Models\Predict;
use App\Traits\FileUpload;
use Carbon\Carbon;

class PredictRepository extends BaseRepository
{
    use FileUpload;

    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return Predict::class;
    }

    public function getListing()
    {
        return Predict::query()
            ->with(['comment'])
            ->orderBy('created_at', 'desc');
    }

    public function createPredict(array $input)
    {
        if (isset($input['image'])) {
            $this->upload_path = 'predicts';
            $this->uploadFile($input['image']);
            // Store just the relative path, not the full URL
            $input['image'] = $this->uploaded_filename;
        }

        $model = new Predict();
        $model->fill($input);
        $model->save();
    }

    public function updatePredict(array $input, int $id)
    {
        if (isset($input['image'])) {
            $this->upload_path = 'predicts';
            // Use overwriteFile to properly replace the old image
            $this->overwriteFile($input['image'], $input['original_image'] ?? '');
            // Store just the relative path, not the full URL
            $input['image'] = $this->uploaded_filename;
        } else {
            // If no new image is uploaded, retain the original image
            $input['image'] = $input['original_image'] ?? null;
        }

        $model = Predict::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function deletePredict(int $id)
    {
        $model = Predict::findOrFail($id);
        
        // Delete associated image file if exists
        if ($model->image) {
            $this->upload_path = 'predicts';
            $this->deleteFile($model->image);
        }
        
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = Predict::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    /**
     * Get active predictions for frontend display
     */
    public function getActivePredictions($perPage = 10)
    {
        return Predict::with(['matches', 'comment.user', 'like'])
            ->where('status', Predict::STATUS['ACTIVE'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get active predictions by specific expert
     */
    public function getActivePredictionsByExpert($expert, $perPage = 10)
    {
        return Predict::with(['matches', 'comment.user'])
            ->where('status', Predict::STATUS['ACTIVE'])
            ->where('character_name', $expert)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get active prediction by ID with relationships
     */
    public function getActivePredictionById($id)
    {
        return Predict::with(['matches', 'comment.user'])
            ->where('id', $id)
            ->where('status', Predict::STATUS['ACTIVE'])
            ->first();
    }

    /**
     * Get related predictions based on character or match
     */
    public function getRelatedPredictions($prediction, $limit = 3)
    {
        return Predict::with(['matches'])
            ->where('status', Predict::STATUS['ACTIVE'])
            ->where('id', '!=', $prediction->id)
            ->where(function($query) use ($prediction) {
                $query->where('character_name', $prediction->character_name)
                      ->orWhere('match_id', $prediction->match_id);
            })
            ->withCount('comment')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get featured predictions (top predictions with most likes)
     */
    public function getFeaturedPredictions($limit = 3)
    {
        return Predict::with(['matches'])
            ->where('status', Predict::STATUS['ACTIVE'])
            ->withCount('comment')
            ->orderBy('comment_count', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Get prediction statistics
     */
    public function getPredictionStats()
    {
        return [
            'total_predictions' => Predict::where('status', Predict::STATUS['ACTIVE'])->count(),
            'total_characters' => count(Predict::CHARACTER),
            'total_matches_predicted' => Predict::where('status', Predict::STATUS['ACTIVE'])
                ->distinct('match_id')
                ->count('match_id'),
        ];
    }

    /**
     * Get character constants
     */
    public function getCharacters()
    {
        return Predict::CHARACTER;
    }
}
