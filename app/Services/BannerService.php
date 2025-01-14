<?php

namespace App\Services;

use App\Models\Banner;

class BannerService
{
    protected $BannerModel;

    public function __construct()
    {
        $this->BannerModel = new Banner();
    }

    public function addBanner($data = [])
    {
        return $this->BannerModel->create([
            'banner_image' => $data['banner_image'],
            'banner_link' => $data['banner_link']
        ]);
    }

    public function fetch(int $banner_id = 0)
    {
        return $this->BannerModel->find($banner_id);
    }

    public function fetchRecord($data = [])
    {
        $banners = [];
    
        $this->BannerModel->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$banners) {
            foreach ($chunk as $banner) {
                $banners[] = $banner;
            }
        });
    
        return collect($banners);
    }

    public function editBanner($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $banner = $this->BannerModel->find($id);

        $fieldsToUpdate = [
            'banner_link' => $data['banner_link']
        ];

        if(isset($data['banner_image'])){
            $fieldsToUpdate['banner_image'] = $data['banner_image'];
        }

        if ($banner) {
            $response = $this->BannerModel->where('id', $id)->update($fieldsToUpdate);

            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Banner details updated successfully.'
                ];
            }
        }
    }
}
