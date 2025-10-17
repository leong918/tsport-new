<?php

namespace App\Repositories;

use App\Models\Matches;
use App\Traits\FileUpload;
use Carbon\Carbon;

class MatchRepository extends BaseRepository
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
        return Matches::class;
    }

    public function getListing()
    {
        return Matches::query()->orderBy('created_at', 'desc');
    }

    public function createMatch(array $input)
    {

        if (isset($input['banner'])) {
            $this->upload_path = 'match';
            $this->uploadFile($input['banner']);

            $input['banner'] = $this->uploaded_filename;
        } else {
            $input['banner'] = $input['original_banner'];
        }

        $model = new Matches();
        $model->fill($input);
        $model->save();
    }

    public function updateMatch(array $input, int $id)
    {

        if (isset($input['banner'])) {
            $this->upload_path = 'match';
            $this->overwriteFile($input['banner'], $input['original_banner']);

            $input['banner'] = $this->uploaded_filename;
        } else {
            $input['banner'] = $input['original_banner'];
        }

        $model = Matches::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function deleteMatch(int $id)
    {
        $model = Matches::findOrFail($id);

        $this->upload_path = 'match';
        $this->deleteFile($model->banner);

        $model->deleteTranslations();
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = Matches::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function toggleTop(int $id)
    {
        $model = Matches::find($id);
        $model->is_top = !$model->is_top;
        $model->save();
        
        return $model;
    }

    /**
     * Get all active matches
     */
    public function getActiveMatches()
    {
        return Matches::active()->get();
    }

    /**
     * Get top matches for display
     */
    public function getTopMatches()
    {
        return Matches::active()->where('is_top', true)->get();
    }

    /**
     * Get regular (non-top) matches for display
     */
    public function getRegularMatches()
    {
        return Matches::active()->where('is_top', false)->get();
    }

    /**
     * Format matches for frontend display
     */
    public function formatMatchesForDisplay($matches)
    {
        return $matches->map(function ($match) {
            // Check if this match has an active live stream
            $liveMatch = \App\Models\LiveMatch::where('match_id', $match->id)
                ->where('status', 1)
                ->first();
            
            return [
                'id' => $match->id,
                'title' => $match->match_title,
                'league' => $match->short_content ?? 'Sports League',
                'status' => $match->status == 1 ? '直播中' : '已结束',
                'image' => $match->banner_url ?? '/assets/web/assets/img/matches/default.jpg',
                'time' => $match->start_at ? $match->start_at->format('Y/m/d H:i') : 'TBD',
                'is_top' => $match->is_top,
                'has_live' => $liveMatch ? true : false,
                'live_match_id' => $liveMatch ? $liveMatch->id : null,
                'is_streaming' => $liveMatch && $liveMatch->obs_status == 2,
            ];
        })->values()->toArray();
    }
}
