<?php
class SanPham {
    public $id_sp, $Name, $Price, $Date_import, $Viewsp, $Decribe, $Mount, $Sale, $image, $id_danhmuc;

    public function __construct(array $data = []) {
        $this->id_sp = $data['id_sp'] ?? null;
        $this->Name = $data['Name'] ?? '';
        $this->Price = $data['Price'] ?? 0;
        $this->Date_import = $data['Date_import'] ?? date('Y-m-d');
        $this->Viewsp = $data['Viewsp'] ?? 0;
        $this->Decribe = $data['Decribe'] ?? '';
        $this->Mount = $data['Mount'] ?? 0;
        $this->Sale = $data['Sale'] ?? 0;
        $this->image = $data['image'] ?? '';
        $this->id_danhmuc = $data['id_danhmuc'] ?? 1;
    }
}
