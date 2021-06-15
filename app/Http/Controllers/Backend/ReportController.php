<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class ReportController extends Controller
{
    public function index() {
        return view('backend.report');
    }

    public function export() {
        // Data
        $election = Election::first();
        $candidates = $election->candidates;
        $votes = $election->votes;
        $candidates_column = range('B', 'D');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        $column = 2;
        $number = 1;
        // Set Header
        foreach ($candidates_column as $column_alphanumeric) {
            $sheet->setCellValue("B$column", "NO")
                ->setCellValue("C$column", "NAMA KANDIDAT")
                ->setCellValue("D$column", "TOTAL PEMILIH")->getColumnDimension($column_alphanumeric)->setAutoSize(true);
        }
        $column++;
        foreach($candidates as $candidate) {
            $sheet->setCellValue("B$column", $number)
                ->setCellValue("C$column", $candidate->name)
                ->setCellValue("D$column", $candidate->votes());
            $number++;
            $column++;
        }
        $column += 2;

        $number = 1;
        $votes_column = range('B', 'E');
        foreach ($votes_column as $column_alphanumeric) {
            $sheet->setCellValue("B$column", "NO")
                ->setCellValue("C$column", "NAMA PEMILIH")
                ->setCellValue("D$column", "PILIHAN")
                ->setCellValue("E$column", "WAKTU MEMILIH")->getColumnDimension($column_alphanumeric)->setAutoSize(true);
        }
        $column++;
        foreach($votes as $vote) {
            $sheet->setCellValue("B$column", $number)
                ->setCellValue("C$column", $vote->voter->user->name)
                ->setCellValue("D$column", $vote->candidate->name)
                ->setCellValue("E$column", $vote->voter->selected_date->format('d-m-Y H:m:s'));
            $number++;
            $column++;
        }
        $file_name = '[HASIL VOTING]' . date('d-m-Y');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xls"');
        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
    }
}
