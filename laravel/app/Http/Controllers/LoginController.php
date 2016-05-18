<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

	class LoginController extends Controller
	{
		public function index()
		{
			// return view('login');
		}
		/**
		 * 登录
		 *
		 */
		public function login()
		{
			return view('login');
		}
		/**
		 * 注册
		 * 
		 */
		public function register()
		{
			return view('register');
		}
	}
