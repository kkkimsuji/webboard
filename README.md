# 🚀 PHP 기반 웹 게시판 프로젝트 (WebBoard)

사용자 인증부터 게시글 관리(CRUD)까지 웹 서비스의 핵심 로직을 직접 구현한 PHP 프로젝트입니다. 단순한 기능 구현을 넘어 **보안성**과 **유지보수성**을 고려하여 폴더 구조를 체계적으로 리팩토링하였습니다.

## 📺 프로젝트 미리보기
(https://github.com/kkkimsuji/webboard/files/12481533/_.pdf)

---

## ✨ 주요 구현 기능

### 1. 사용자 인증 및 회원 관리 (User Management)
* **로그인/로그아웃**: PHP 세션(Session)을 활용한 상태 유지 및 안전한 로그아웃 처리.
* **회원가입**: 아이디 중복 체크 로직 및 사용자 데이터 DB 연동.
* **마이페이지**: 가입 정보(아이디, 이름, 이메일) 확인 기능.
* **비밀번호 변경**: 보안을 고려한 기존 비밀번호 업데이트 프로세스 구현.
* **회원 탈퇴**: 세션 파괴 및 DB 레코드 삭제를 포함한 데이터 정리 로직.

### 2. 게시판 시스템 (Board CRUD)
* **목록 보기**: 페이징 로직(10개씩 출력)이 적용된 동적 게시글 목록 페이지.
* **게시글 작성**: 세션 기반 작성자 자동 매칭 및 데이터 유효성 검사.
* **상세 보기**: 게시글 내용 확인 및 조회수 자동 증가 로직.
* **수정/삭제**: **Server-side 권한 검증**을 통해 작성자 본인만 관리 가능하도록 구현.

---

## 🛠 사용 기술 (Tech Stack)
* **Backend**: `PHP 7.4+`, `MySQL / MariaDB`
* **Frontend**: `HTML5`, `CSS3` (Gowun Dodum 웹 폰트 적용)
* **Environment**: `VS Code`, `GitHub`

---

## 📂 리팩토링된 폴더 구조 (Project Structure)
가독성과 유지보수 편의를 위해 역할별로 파일을 체계적으로 분리했습니다.



```text
WEBBOARD/
├── config/           # 데이터베이스 연결 및 서버 설정
│   └── db.php
├── css/              # 디자인 자산 및 공통 스타일시트
│   ├── style.css
│   └── table.css
├── process/          # 화면 없이 비즈니스 로직만 처리하는 엔진
│   ├── login.php
│   ├── logout.php
│   ├── write_proc.php
│   ├── mod_proc.php
│   ├── del_proc.php
│   └── ... (기타 처리 파일)
├── README.md         # 프로젝트 설명서
├── board_list.php    # 게시판 목록 UI
├── board_view.php    # 게시글 상세 UI
├── main.php          # 마이페이지 UI
├── login.html        # 로그인 UI
└── ... (기타 UI 화면)
