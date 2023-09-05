<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RefreshTokenController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CommitteeMemberController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/**
 * 로그인 관련 API
 */
Route::prefix('auth')->group(function () {
  Route::post('/login', [LoginController::class, 'login'])->name('api.login');
  Route::post('/register', [RegisterController::class, 'store'])->name('api.register');
  Route::post('/logout', [LogoutController::class, 'logout'])->middleware(['auth:sanctum'])->name('api.logout');
  Route::post('/refresh_token', [RefreshTokenController::class, 'refreshToken'])->name('api.refresh_token');
});

Route::get('/business', [BusinessController::class, 'index']);
/**
 * Seminars API
 */
Route::get(
  '/seminars',
  [SeminarController::class, 'index']
)->name('api.seminars.index');

Route::post(
  '/seminars',
  [SeminarController::class, 'store']
)->name('api.seminars.store');

Route::get(
  '/seminars/total',
  [SeminarController::class, 'total']
)->name('api.seminars.total');

Route::get(
  '/seminars/ongoing',
  [SeminarController::class, 'ongoingSeminars']
)->name('api.seminars.ongoing');

Route::get(
  '/seminars/past',
  [SeminarController::class, 'pastSeminars']
)->name('api.seminars.past');

Route::get(
  '/seminars/search',
  [SeminarController::class, 'search']
)->name('api.seminars.search');

Route::get(
  '/seminars/{id}',
  [SeminarController::class, 'show']
)->name('api.seminars.id');

Route::put(
  '/seminars/{id}',
  [SeminarController::class, 'update']
)->name('api.seminars');

Route::delete(
  '/seminars/{id}',
  [SeminarController::class, 'destroy']
)->name('api.seminars');

/**
 * Post API
 */
Route::get(
  '/post',
  [PostController::class, 'index']
)->name('api.post');

Route::post(
  '/post',
  [PostController::class, 'store']
)->name('api.post');

Route::get(
  '/post/total',
  [PostController::class, 'total']
)->name('api.post');

Route::get(
  '/post/search',
  [PostController::class, 'search']
)->name('api.post');

Route::get(
  '/post/{id}',
  [PostController::class, 'show']
)->name('api.post');

Route::put(
  '/post/{id}',
  [PostController::class, 'update']
)->name('api.post');

Route::delete(
  '/post/{id}',
  [PostController::class, 'destroy']
)->name('api.post');

/**
 * AboutUs API
 */
Route::get(
  '/aboutus/objective',
  [AboutUsController::class, 'showObjective']
)->name('api.aboutus.objective');

Route::get(
  '/aboutus/vision',
  [AboutUsController::class, 'showVision']
)->name('api.aboutus.vision');

Route::get(
  '/aboutus/histories',
  [HistoriesController::class, 'index']
)->name('api.aboutus.histories');

Route::get(
  '/aboutus/greetings',
  [AboutUsController::class, 'showGreetings']
)->name('api.aboutus.greetings');

Route::get(
  '/aboutus/rules',
  [AboutUsController::class, 'showRules']
)->name('api.aboutus.rules');

Route::get(
  '/aboutus/ci_logo',
  [AboutUsController::class, 'showCiLogo']
)->name('api.aboutus.ci_logo');

Route::post(
  '/aboutus',
  [AboutUsController::class, 'store']
)->name('api.aboutus');


// File Upload API
Route::post(
  '/upload',
  [FileController::class, 'store']
)->name('api.upload');

Route::delete(
  '/upload',
  [FileController::class, 'destory']
)->name('api.upload');


/**
 * 관리자 권한 요함
 */
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
  /** 
  * 통계 데이터 
  */
  Route::get('/committees/count', [CommitteeController::class, 'count'])->name('api.committees');
  Route::get('/members/count', [MemberController::class, 'count'])->name('api.committees');
  Route::get('/users/count', [UserController::class, 'count'])->name('api.committees');
/**
 * 위원회 관련 API
 */

Route::get('/committees', [CommitteeController::class, 'index'])->name('api.committees');
Route::post('/committees', [CommitteeController::class, 'store'])->name('api.committees');

Route::get('/committee/{id}', [CommitteeController::class, 'find'])->name('api.committee');
Route::put('/committee/{id}', [CommitteeController::class, 'update'])->name('api.committees');
Route::delete('/committee/{id}', [CommitteeController::class, 'destroy'])->name('api.committees');

/**
 * 위원회 멤버 관련 API
 */
Route::get('/committee/{id}/members', [CommitteeMemberController::class, 'index'])->name('api.committees');
Route::post('/committee/{id}/members', [CommitteeMemberController::class, 'store'])->name('api.committees.members');
Route::put('/committee/{c_id}/members/{m_id}', [CommitteeMemberController::class, 'update'])->name('api.committees.members');
Route::delete('/committee/{c_id}/members/{m_id}', [CommitteeMemberController::class, 'destroy'])->name('api.committees.members');

/**
 * 주요사업 관련 API
 */
Route::post('/business', [BusinessController::class, 'store'])->name('api.business');
Route::put('/business/{business}', [BusinessController::class, 'update'])->name('api.business');
Route::delete('/business/{business}', [BusinessController::class, 'destroy'])->name('api.business');

/**
 * 사용자 관련 API
 */
Route::get('/users', [UserController::class, 'index'])->name('api.users');
Route::delete('/users/{email}', [UserController::class, 'destroy'])->name('api.users');
Route::put('/users/approval', [UserController::class, 'approval'])->name('api.users');

/**
 * 회원 관련 API
 */
Route::get('/members', [MemberController::class, 'index'])->name('api.members');
Route::put('/members', [MemberController::class, 'update'])->name('api.members');
Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('api.members');
});